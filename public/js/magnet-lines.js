/**
 * ZenyDesk ERP — MagnetLines Background Engine
 * React Bits Port (Vanilla WebGL2 Native)
 * Usage: window.initMagnetLines(containerElement, options)
 */
(function (global) {
  'use strict';

  var VERTEX = `#version 300 es
layout(location = 0) in vec2 aCorner;
layout(location = 1) in vec2 aCenter;
layout(location = 2) in vec4 aState;
uniform mat3 uView;
uniform vec2 uCanvas;
uniform vec2 uOffset;
uniform vec2 uLine;
uniform float uStretch;
uniform float uHead;
uniform float uPad;
uniform float uFar;
out vec2 vLocal;
out vec2 vHalf;
out float vEmphasis;
out float vFlash;
out float vAngle;
out float vShown;
void main() {
  float angle = aState.x;
  float emphasis = aState.y;
  float halfLength = uLine.x * (1.0 + uStretch * emphasis);
  float halfWidth = uLine.y;
  vec2 extent = vec2(halfLength + uPad, max(halfWidth, uHead * halfLength) + uPad);
  vec2 local = aCorner * extent;
  vec2 axis = vec2(cos(angle), sin(angle));
  vec2 point = aCenter + axis * local.x + vec2(-axis.y, axis.x) * local.y;
  vec3 screen = uView * vec3(point, 1.0);
  vec2 scale = vec2(2.0 / uCanvas.x, -2.0 / uCanvas.y);
  vec2 shift = vec2(-1.0 + 2.0 * uOffset.x / uCanvas.x, 1.0 - 2.0 * uOffset.y / uCanvas.y);
  gl_Position = vec4(screen.xy * scale + shift * screen.z, 0.0, screen.z);
  float depth = (uView * vec3(aCenter, 1.0)).z;
  vLocal = local;
  vHalf = vec2(halfLength, halfWidth);
  vEmphasis = emphasis;
  vFlash = aState.z;
  vAngle = angle;
  vShown = aState.w * (1.0 - smoothstep(uFar * 0.45, uFar, depth));
}`;

  var FRAGMENT = `#version 300 es
precision highp float;
in vec2 vLocal;
in vec2 vHalf;
in float vEmphasis;
in float vFlash;
in float vAngle;
in float vShown;
out vec4 fragColor;
uniform vec3 uColor;
uniform vec3 uAccent;
uniform float uAccentMix;
uniform float uOpacity;
uniform float uFade;
uniform int uShape;
uniform float uHead;
uniform float uRainbow;
uniform float uTone;
uniform float uPeriod;
uniform vec2 uCanvas;
uniform vec2 uOffset;
uniform vec2 uPixels;
uniform vec2 uEdge;

float ndot(vec2 a, vec2 b) {
  return a.x * b.x - a.y * b.y;
}

float rhombus(vec2 p, vec2 b) {
  p = abs(p);
  float h = clamp(ndot(b - 2.0 * p, b) / dot(b, b), -1.0, 1.0);
  float d = length(p - 0.5 * b * vec2(1.0 - h, 1.0 + h));
  return d * sign(p.x * b.y + p.y * b.x - b.x * b.y);
}

float triangle(vec2 p, vec2 q) {
  p.x = abs(p.x);
  vec2 a = p - q * clamp(dot(p, q) / dot(q, q), 0.0, 1.0);
  vec2 b = p - q * vec2(clamp(p.x / q.x, 0.0, 1.0), 1.0);
  float s = -sign(q.y);
  vec2 d = min(vec2(dot(a, a), s * (p.x * q.y - p.y * q.x)), vec2(dot(b, b), s * (p.y - q.y)));
  return -sqrt(d.x) * sign(d.y);
}

float capsule(vec2 p, float from, float to, float radius) {
  float x = clamp(p.x, from, to);
  return length(vec2(p.x - x, p.y)) - radius;
}

float feather(float distance, float zone) {
  if (zone <= 0.0) return 1.0;
  float t = clamp(distance / zone, 0.0, 1.0);
  return t * t * t * (t * (t * 6.0 - 15.0) + 10.0);
}

vec3 spectrum(float hue, float tone) {
  vec3 k = clamp(abs(fract(hue + vec3(0.0, 2.0, 1.0) / 3.0) * 6.0 - 3.0) - 1.0, 0.0, 1.0);
  k = k * k * (3.0 - 2.0 * k);
  float chroma = (1.0 - abs(2.0 * tone - 1.0)) * 0.92;
  return tone + chroma * (k - 0.5);
}

void main() {
  vec2 p = vLocal;
  float aa = max(length(fwidth(p)) * 0.7071, 0.0001);
  float halfWidth = max(vHalf.y, aa * 0.5);
  float thin = vHalf.y / halfWidth;
  float halfLength = max(vHalf.x, halfWidth);
  float d;
  if (uShape == 1) {
    float head = min(halfLength * 0.9, max(halfWidth * 4.5, halfLength * 0.55));
    float wing = max(uHead * halfLength, halfWidth * 2.2);
    float shaft = capsule(p, -halfLength + halfWidth, halfLength - head * 0.6, halfWidth);
    float tip = triangle(vec2(p.y, halfLength - p.x), vec2(wing, head));
    d = min(shaft, tip);
  } else if (uShape == 2) {
    d = rhombus(p, vec2(halfLength, max(uHead * halfLength, halfWidth)));
  } else {
    d = capsule(p, -halfLength + halfWidth, halfLength - halfWidth, halfWidth);
  }
  float coverage = clamp(0.5 - d / aa, 0.0, 1.0) * thin;
  if (coverage <= 0.0) discard;

  float emphasis = clamp(vEmphasis + vFlash, 0.0, 1.0);
  vec3 color = mix(uColor, uAccent, uAccentMix * emphasis);
  if (uShape == 2) {
    float north = smoothstep(-aa, aa, p.x);
    color = mix(uColor, uAccent, north);
  }
  if (uRainbow > 0.5) {
    float hue = fract(vAngle / uPeriod);
    vec3 tint = spectrum(hue, uTone);
    color = uShape == 2 ? mix(tint, uColor, 1.0 - smoothstep(-aa, aa, p.x)) : tint;
  }
  float alpha = uOpacity * mix(1.0 - uFade, 1.0, clamp(vEmphasis, 0.0, 1.0));
  alpha = clamp(alpha + vFlash * 0.6, 0.0, 1.0) * coverage * vShown;
  vec2 point = vec2(gl_FragCoord.x, uPixels.y - gl_FragCoord.y) * (uCanvas / uPixels) - uOffset;
  vec2 inside = min(point, uCanvas - 2.0 * uOffset - point);
  alpha *= feather(inside.x, uEdge.x) * feather(inside.y, uEdge.y);
  fragColor = vec4(color * alpha, alpha);
}`;

  var MODES = ['orbit', 'attract', 'spiral', 'dipole'];
  var SHAPES = { line: 0, arrow: 1, needle: 2 };
  var TAU = Math.PI * 2;
  var PULSE_SPEED = 520;
  var PULSE_SPIN = 0.34;
  var INTRO_SPEED = 700;
  var INTRO_TIME = 1.1;
  var INTRO_SPIN = 0.65;
  var FAR = 4;
  var MAX_LINES = 30000;

  var clamp = function (v, min, max) { return Math.min(max, Math.max(min, v)); };
  var smootherstep = function (t) { return t * t * t * (t * (t * 6 - 15) + 10); };
  var wrap = function (value, period) {
    var half = period / 2;
    return ((((value + half) % period) + period) % period) - half;
  };

  var seedFor = function (column, row) {
    var hash = Math.imul(column + 40503, 2246822519) ^ Math.imul(row + 9973, 3266489917);
    hash = Math.imul(hash ^ (hash >>> 15), 668265263);
    hash = Math.imul(hash ^ (hash >>> 13), 374761393);
    return (((hash ^ (hash >>> 16)) >>> 0) / 4294967296) * 2 - 1;
  };

  var parseColor = function (value) {
    var text = String(value || '').trim();
    var hex = /^#?([0-9a-f]{3}|[0-9a-f]{6})$/i.exec(text);
    if (hex) {
      var full = hex[1].length === 3 ? hex[1].replace(/./g, function (d) { return d + d; }) : hex[1];
      return [0, 2, 4].map(function (idx) { return parseInt(full.slice(idx, idx + 2), 16) / 255; });
    }
    var rgb = /^rgba?\(\s*([\d.]+)[\s,]+([\d.]+)[\s,]+([\d.]+)/i.exec(text);
    if (rgb) return [rgb[1], rgb[2], rgb[3]].map(function (c) { return clamp(parseFloat(c) / 255, 0, 1); });
    return [0.94, 0.94, 0.94];
  };

  var lightness = function (rgb) { return (Math.max.apply(Math, rgb) + Math.min.apply(Math, rgb)) / 2; };

  var compile = function (gl, type, source) {
    var shader = gl.createShader(type);
    if (!shader) return null;
    gl.shaderSource(shader, source);
    gl.compileShader(shader);
    if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
      console.error(gl.getShaderInfoLog(shader));
      gl.deleteShader(shader);
      return null;
    }
    return shader;
  };

  var link = function (gl) {
    var vertex = compile(gl, gl.VERTEX_SHADER, VERTEX);
    var fragment = compile(gl, gl.FRAGMENT_SHADER, FRAGMENT);
    var program = vertex && fragment ? gl.createProgram() : null;
    if (!vertex || !fragment || !program) {
      if (vertex) gl.deleteShader(vertex);
      if (fragment) gl.deleteShader(fragment);
      return null;
    }
    gl.attachShader(program, vertex);
    gl.attachShader(program, fragment);
    gl.linkProgram(program);
    gl.deleteShader(vertex);
    gl.deleteShader(fragment);
    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
      console.error(gl.getProgramInfoLog(program));
      gl.deleteProgram(program);
      return null;
    }
    var uniforms = {};
    var count = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
    for (var i = 0; i < count; i++) {
      var info = gl.getActiveUniform(program, i);
      if (info) uniforms[info.name] = gl.getUniformLocation(program, info.name);
    }
    return { program: program, uniforms: uniforms };
  };

  var multiply = function (a, b) {
    var out = [];
    for (var r = 0; r < 3; r++) {
      for (var c = 0; c < 3; c++) {
        out.push(a[r * 3] * b[c] + a[r * 3 + 1] * b[c + 3] + a[r * 3 + 2] * b[c + 6]);
      }
    }
    return out;
  };

  var invert = function (m) {
    var a = m[0], b = m[1], c = m[2], d = m[3], e = m[4], f = m[5], g = m[6], h = m[7], i = m[8];
    var A = e * i - f * h;
    var B = f * g - d * i;
    var C = d * h - e * g;
    var det = a * A + b * B + c * C;
    return [A, c * h - b * i, b * f - c * e, B, a * i - c * g, c * d - a * f, C, b * g - a * h, a * e - b * d].map(
      function (v) { return v / det; }
    );
  };

  var apply = function (m, x, y) {
    var w = m[6] * x + m[7] * y + m[8];
    return [(m[0] * x + m[1] * y + m[2]) / w, (m[3] * x + m[4] * y + m[5]) / w, w];
  };

  var viewFor = function (tiltX, tiltY, width, height, fill) {
    var ax = (tiltX * Math.PI) / 180;
    var ay = (tiltY * Math.PI) / 180;
    var depth = Math.max(width, height) * 1.25;
    var tilt = [
      Math.cos(ay), 0, 0,
      Math.sin(ax) * Math.sin(ay), Math.cos(ax), 0,
      (Math.sin(ay) * Math.cos(ax)) / depth, -Math.sin(ax) / depth, 1
    ];
    if (fill) {
      var forward = multiply([1, 0, width / 2, 0, 1, height / 2, 0, 0, 1], tilt);
      return { forward: forward, inverse: invert(forward), minScale: 1, maxScale: 1 };
    }
    var corners = [
      [-width / 2, -height / 2],
      [width / 2, -height / 2],
      [width / 2, height / 2],
      [-width / 2, height / 2]
    ].map(function (p) { return apply(tilt, p[0], p[1]); });
    var xs = corners.map(function (p) { return p[0]; });
    var ys = corners.map(function (p) { return p[1]; });
    var spanX = Math.max.apply(Math, xs) - Math.min.apply(Math, xs);
    var spanY = Math.max.apply(Math, ys) - Math.min.apply(Math, ys);
    var fit = Math.min(1, width / Math.max(1, spanX), height / Math.max(1, spanY));
    var midX = (Math.max.apply(Math, xs) + Math.min.apply(Math, xs)) / 2;
    var midY = (Math.max.apply(Math, ys) + Math.min.apply(Math, ys)) / 2;
    var place = [fit, 0, width / 2 - midX * fit, 0, fit, height / 2 - midY * fit, 0, 0, 1];
    var forward2 = multiply(place, tilt);
    var scales = corners.map(function (p) { return fit / Math.abs(p[2]); });
    return {
      forward: forward2,
      inverse: invert(forward2),
      minScale: Math.min.apply(Math, scales),
      maxScale: Math.max.apply(Math, scales)
    };
  };

  var visibleRange = function (view, width, height, cellX, cellY) {
    var inverse = view.inverse;
    var edge = Math.max(cellX, cellY) * 2;
    var corners = [
      [-edge, -edge],
      [width + edge, -edge],
      [width + edge, height + edge],
      [-edge, height + edge]
    ];
    var depthOf = function (p) { return inverse[6] * p[0] + inverse[7] * p[1] + inverse[8] - 1 / FAR; };
    var hull = [];
    corners.forEach(function (from, idx) {
      var to = corners[(idx + 1) % corners.length];
      var a = depthOf(from);
      var b = depthOf(to);
      if (a >= 0) hull.push(from);
      if ((a >= 0) !== (b >= 0)) {
        var t = a / (a - b);
        hull.push([from[0] + (to[0] - from[0]) * t, from[1] + (to[1] - from[1]) * t]);
      }
    });
    if (hull.length < 3) return null;
    var minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;
    for (var i = 0; i < hull.length; i++) {
      var pt = apply(inverse, hull[i][0], hull[i][1]);
      minX = Math.min(minX, pt[0]);
      minY = Math.min(minY, pt[1]);
      maxX = Math.max(maxX, pt[0]);
      maxY = Math.max(maxY, pt[1]);
    }
    return {
      fromColumn: Math.floor((minX + width / 2) / cellX - 0.5) - 1,
      toColumn: Math.ceil((maxX + width / 2) / cellX - 0.5) + 1,
      fromRow: Math.floor((minY + height / 2) / cellY - 0.5) - 1,
      toRow: Math.ceil((maxY + height / 2) / cellY - 0.5) + 1
    };
  };

  function initMagnetLines(container, userOptions) {
    if (!container) return null;
    var opts = userOptions || {};

    var canvas = container.querySelector('canvas.magnet-lines__canvas');
    if (!canvas) {
      canvas = document.createElement('canvas');
      canvas.className = 'magnet-lines__canvas';
      canvas.setAttribute('aria-hidden', 'true');
      container.appendChild(canvas);
    }

    var probe = container.querySelector('.magnet-lines__probe');
    if (!probe) {
      probe = document.createElement('span');
      probe.className = 'magnet-lines__probe';
      probe.setAttribute('aria-hidden', 'true');
      container.appendChild(probe);
    }

    var gl = canvas.getContext('webgl2', {
      alpha: true,
      premultipliedAlpha: true,
      antialias: false,
      depth: false,
      stencil: false,
      powerPreference: 'default'
    });
    if (!gl) return null;

    var program = link(gl);
    if (!program) return null;

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var vao = gl.createVertexArray();
    gl.bindVertexArray(vao);
    var cornerBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, cornerBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, 1, 1]), gl.STATIC_DRAW);
    gl.enableVertexAttribArray(0);
    gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);

    var centerBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, centerBuffer);
    gl.enableVertexAttribArray(1);
    gl.vertexAttribPointer(1, 2, gl.FLOAT, false, 0, 0);
    gl.vertexAttribDivisor(1, 1);

    var stateBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, stateBuffer);
    gl.enableVertexAttribArray(2);
    gl.vertexAttribPointer(2, 4, gl.FLOAT, false, 0, 0);
    gl.vertexAttribDivisor(2, 1);

    gl.enable(gl.BLEND);
    gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);

    var color = parseColor(opts.lineColor || '#efefef');
    var accent = opts.accentColor ? parseColor(opts.accentColor) : null;
    var shape = SHAPES[opts.shape] !== undefined ? opts.shape : 'line';
    var settings = {
      square: false,
      spacing: Math.max(4, Number(opts.spacing) || 30),
      rows: opts.rows ? clamp(Math.round(opts.rows), 1, 400) : 0,
      columns: opts.columns ? clamp(Math.round(opts.columns), 1, 400) : 0,
      lineWidth: opts.lineWidth !== undefined ? opts.lineWidth : 2,
      lineHeight: opts.lineHeight !== undefined ? opts.lineHeight : 18,
      baseAngle: ((opts.baseAngle !== undefined ? opts.baseAngle : -10) * Math.PI) / 180,
      mode: MODES.indexOf(opts.mode) !== -1 ? opts.mode : 'orbit',
      shape: shape,
      color: color,
      accent: accent || (shape === 'needle' ? parseColor('#f43f5e') : color),
      accentMix: accent ? 1 : 0,
      rainbow: Boolean(opts.rainbow),
      tone: clamp(lightness(color), 0.42, 0.66),
      radius: Math.max(1, opts.radius !== undefined ? opts.radius : 200),
      fade: clamp(opts.fade !== undefined ? opts.fade : 0.65, 0, 1),
      edgeFade: clamp(opts.edgeFade !== undefined ? opts.edgeFade : 0, 0, 1),
      stretch: clamp(opts.stretch !== undefined ? opts.stretch : 0.4, 0, 2),
      reach: Math.max(0, opts.reach || 0),
      scatter: clamp(opts.scatter || 0, 0, 1),
      inertia: clamp(opts.inertia !== undefined ? opts.inertia : 0.35, 0, 1),
      bounce: clamp(opts.bounce !== undefined ? opts.bounce : 0.3, 0, 1),
      ripple: clamp(opts.ripple !== undefined ? opts.ripple : 0.3, 0, 1),
      clickPulse: opts.clickPulse !== undefined ? opts.clickPulse : true,
      intro: opts.intro !== undefined ? opts.intro : true,
      idle: Boolean(opts.idle),
      tiltX: clamp(opts.tiltX || 0, -70, 70),
      tiltY: clamp(opts.tiltY || 0, -70, 70),
      maxRatio: clamp(opts.maxDevicePixelRatio || 2, 0.5, 3)
    };

    var field = {
      width: 1, height: 1, pad: 0, ratio: 1, view: null,
      length: 20, thickness: 2, fill: true, edgePad: 1,
      minScale: 1, maxScale: 1, introSpeed: INTRO_SPEED,
      bounds: [0, 0, 0, 0], key: ''
    };
    var pointer = { x: 0, y: 0, vx: 0, vy: 0, time: 0, seen: false, inside: false, away: 0 };
    var target = { x: 0, y: 0, heading: 0 };
    var pulses = [];
    var count = 0;
    var centers = new Float32Array(0);
    var cells = new Int32Array(0);
    var reveal = new Float32Array(0);
    var rests = new Float32Array(0);
    var seeds = new Float32Array(0);
    var angles = new Float32Array(0);
    var speeds = new Float32Array(0);
    var seenX = new Float32Array(0);
    var seenY = new Float32Array(0);
    var pending = new Uint8Array(0);
    var state = new Float32Array(0);
    var introStart = -1;
    var introLive = settings.intro && !reduced;
    var raf = 0;
    var last = 0;
    var clock = 0;
    var visible = true;
    var pageVisible = document.visibilityState !== 'hidden';
    var lost = false;
    var dirty = true;

    var measure = function (val) {
      if (typeof val === 'number') return val;
      probe.style.width = String(val);
      return probe.getBoundingClientRect().width;
    };

    var layout = function (width, height, view, columnCount, rowCount, tiled) {
      var cellX = width / columnCount;
      var cellY = height / rowCount;
      var range = tiled
        ? visibleRange(view, width, height, cellX, cellY)
        : { fromColumn: 0, toColumn: columnCount - 1, fromRow: 0, toRow: rowCount - 1 };
      var origin = apply(view.forward, 0, 0);
      var found = [];
      if (range) {
        for (var row = range.fromRow; row <= range.toRow; row++) {
          var y = (row + 0.5) * cellY - height / 2;
          for (var col = range.fromColumn; col <= range.toColumn; col++) {
            var x = (col + 0.5) * cellX - width / 2;
            var pt = apply(view.forward, x, y);
            var screenX = pt[0], screenY = pt[1], w = pt[2];
            if (tiled) {
              if (w <= 0 || w > FAR) continue;
              var margin = (0.49 * Math.min(cellX, cellY)) / w;
              if (screenX < -margin || screenX > width + margin || screenY < -margin || screenY > height + margin)
                continue;
            }
            found.push({ x: x, y: y, column: col, row: row, w: w, distance: Math.hypot(screenX - origin[0], screenY - origin[1]) });
          }
        }
      }
      if (found.length > MAX_LINES) {
        found.sort(function (a, b) { return a.w - b.w; });
        found.length = MAX_LINES;
      }

      var previous = new Map();
      for (var idx = 0; idx < count; idx++) {
        previous.set(cells[idx * 2] * 65536 + cells[idx * 2 + 1], idx);
      }
      var total = found.length;
      var next = {
        centers: new Float32Array(total * 2),
        cells: new Int32Array(total * 2),
        reveal: new Float32Array(total),
        seeds: new Float32Array(total),
        rests: new Float32Array(total),
        angles: new Float32Array(total),
        speeds: new Float32Array(total),
        seenX: new Float32Array(total),
        seenY: new Float32Array(total),
        pending: new Uint8Array(total)
      };
      var farthest = 0, nearest = Infinity, deepest = 0;
      var bounds = [Infinity, Infinity, -Infinity, -Infinity];
      found.forEach(function (item, index) {
        next.centers[index * 2] = item.x;
        next.centers[index * 2 + 1] = item.y;
        next.cells[index * 2] = item.column;
        next.cells[index * 2 + 1] = item.row;
        next.reveal[index] = item.distance;
        next.seeds[index] = seedFor(item.column, item.row);
        farthest = Math.max(farthest, item.distance);
        nearest = Math.min(nearest, item.w);
        deepest = Math.max(deepest, item.w);
        bounds[0] = Math.min(bounds[0], item.x);
        bounds[1] = Math.min(bounds[1], item.y);
        bounds[2] = Math.max(bounds[2], item.x);
        bounds[3] = Math.max(bounds[3], item.y);
        var old = previous.get(item.column * 65536 + item.row);
        if (old === undefined) {
          next.pending[index] = 1;
          return;
        }
        next.angles[index] = angles[old];
        next.speeds[index] = speeds[old];
        next.seenX[index] = seenX[old];
        next.seenY[index] = seenY[old];
      });

      count = total;
      centers = next.centers;
      cells = next.cells;
      reveal = next.reveal;
      seeds = next.seeds;
      rests = next.rests;
      angles = next.angles;
      speeds = next.speeds;
      seenX = next.seenX;
      seenY = next.seenY;
      pending = next.pending;

      state = new Float32Array(total * 4);
      field.introSpeed = Math.max(INTRO_SPEED, farthest / INTRO_TIME);
      field.bounds = total ? bounds : [0, 0, 0, 0];
      field.minScale = total ? 1 / deepest : 1;
      field.maxScale = total ? 1 / nearest : 1;
      gl.bindBuffer(gl.ARRAY_BUFFER, centerBuffer);
      gl.bufferData(gl.ARRAY_BUFFER, centers, gl.STATIC_DRAW);
      gl.bindBuffer(gl.ARRAY_BUFFER, stateBuffer);
      gl.bufferData(gl.ARRAY_BUFFER, state.byteLength || 16, gl.DYNAMIC_DRAW);
    };

    var rebuild = function () {
      var s = settings;
      var rect = container.getBoundingClientRect();
      var width = Math.max(1, rect.width);
      var height = Math.max(1, rect.height);
      var length = Math.max(1, measure(s.lineHeight));
      var thickness = Math.max(0.25, measure(s.lineWidth));
      var fill = true;
      var tiled = fill && (s.tiltX !== 0 || s.tiltY !== 0);
      var view = viewFor(s.tiltX, s.tiltY, width, height, fill);
      var ratio = Math.min(window.devicePixelRatio || 1, s.maxRatio);

      var columnCount = Math.max(1, Math.round(s.columns || (s.rows ? (s.rows * width) / height : width / s.spacing)));
      var rowCount = Math.max(1, Math.round(s.rows || (s.columns ? (s.columns * height) / width : height / s.spacing)));
      if (columnCount * rowCount > MAX_LINES) {
        var shrink = Math.sqrt((columnCount * rowCount) / MAX_LINES);
        columnCount = Math.max(1, Math.floor(columnCount / shrink));
        rowCount = Math.max(1, Math.floor(rowCount / shrink));
      }

      var key = [fill, columnCount, rowCount, width.toFixed(1), height.toFixed(1), tiled ? s.tiltX + ',' + s.tiltY : ''].join('|');
      if (key !== field.key) {
        field.key = key;
        layout(width, height, view, columnCount, rowCount, tiled);
      }

      var minScale = fill ? field.minScale : view.minScale;
      var maxScale = fill ? field.maxScale : view.maxScale;
      var pad = fill ? 0 : Math.ceil((length * (1 + s.stretch) + thickness * 2) * Math.max(1, maxScale) + 8);
      var canvasWidth = width + pad * 2;
      var canvasHeight = height + pad * 2;
      canvas.style.left = -pad + 'px';
      canvas.style.top = -pad + 'px';
      canvas.style.width = canvasWidth + 'px';
      canvas.style.height = canvasHeight + 'px';
      var pixelWidth = Math.max(1, Math.round(canvasWidth * ratio));
      var pixelHeight = Math.max(1, Math.round(canvasHeight * ratio));
      if (canvas.width !== pixelWidth || canvas.height !== pixelHeight) {
        canvas.width = pixelWidth;
        canvas.height = pixelHeight;
      }
      Object.assign(field, {
        width: width, height: height, pad: pad, ratio: ratio,
        view: view, length: length, thickness: thickness, fill: fill,
        edgePad: 2 / (ratio * Math.max(0.05, minScale))
      });
    };

    var fieldAngle = function (s, index, px, py) {
      var dx = px - centers[index * 2];
      var dy = py - centers[index * 2 + 1];
      if (s.mode === 'dipole') {
        var distance = Math.hypot(dx, dy) || 1;
        var rx = -dx / distance;
        var ry = -dy / distance;
        var mx = Math.cos(target.heading);
        var my = Math.sin(target.heading);
        var dot = mx * rx + my * ry;
        return Math.atan2(3 * dot * ry - my, 3 * dot * rx - mx);
      }
      var toward = Math.atan2(dy, dx);
      if (s.mode === 'attract') return toward;
      if (s.mode === 'spiral') return toward + Math.PI / 4;
      return toward + Math.PI / 2;
    };

    var frame = function (now) {
      raf = 0;
      if (lost) return;
      var s = settings;
      var dt = clamp((now - last) / 1000 || 0, 0, 0.05);
      last = Math.max(last, now);
      clock += dt;
      if (dirty) rebuild();
      dirty = false;

      var period = s.shape === 'line' ? Math.PI : TAU;
      var spread = s.scatter * Math.PI * 0.5;
      for (var idx = 0; idx < count; idx++) {
        rests[idx] = s.baseAngle + Math.PI / 2 + seeds[idx] * spread;
      }

      var wandering = s.idle && !reduced && (!pointer.seen || pointer.away > 1.2);
      if (pointer.seen && !pointer.inside) pointer.away += dt;
      var px = pointer.seen ? pointer.x : 0;
      var py = pointer.seen ? pointer.y : 0;
      if (wandering) {
        var amount = Math.min(field.width, field.height) * 0.32;
        px = Math.cos(clock * 0.37) * amount + Math.sin(clock * 0.21) * amount * 0.35;
        py = Math.sin(clock * 0.53 + 1.3) * amount * 0.8;
      }
      var follow = 1 - Math.exp(-dt / (pointer.seen && !wandering ? 0.035 : 0.6));
      target.x += (px - target.x) * follow;
      target.y += (py - target.y) * follow;
      var speed = Math.hypot(pointer.vx, pointer.vy);
      if (speed > 40) {
        var turn = wrap(Math.atan2(pointer.vy, pointer.vx) - target.heading, TAU);
        target.heading += turn * (1 - Math.exp(-dt / 0.25));
      }
      pointer.vx *= Math.exp(-dt / 0.12);
      pointer.vy *= Math.exp(-dt / 0.12);

      if (introLive && introStart < 0) introStart = clock;
      var introTime = introLive ? clock - introStart : Infinity;
      var introBusy = false;

      var stiffness = s.inertia <= 0 || reduced ? 0 : Math.pow(6 + 42 * Math.pow(1 - s.inertia, 2), 2);
      var damping = stiffness ? 2 * Math.sqrt(stiffness) * (1 - 0.75 * s.bounce) : 0;
      var steps = stiffness ? Math.max(1, Math.ceil(dt / (1 / 240))) : 0;
      var h = steps ? dt / steps : 0;
      var lag = reduced ? 0 : s.ripple / 900;
      var radius = s.radius;
      var reachIn = s.reach * 0.55;
      var reachOut = s.reach;

      for (var pIdx = pulses.length - 1; pIdx >= 0; pIdx--) {
        var age = clock - pulses[pIdx].start;
        if (age > pulses[pIdx].life) pulses.splice(pIdx, 1);
      }

      var moving = false;
      for (var i = 0; i < count; i++) {
        var cx = centers[i * 2];
        var cy = centers[i * 2 + 1];
        var born = pending[i] === 1;
        if (born) {
          seenX[i] = target.x;
          seenY[i] = target.y;
        } else {
          var distance = Math.hypot(target.x - cx, target.y - cy);
          var tau = lag * distance;
          var k = tau > 0 ? 1 - Math.exp(-dt / tau) : 1;
          seenX[i] += (target.x - seenX[i]) * k;
          seenY[i] += (target.y - seenY[i]) * k;
          if (Math.abs(target.x - seenX[i]) + Math.abs(target.y - seenY[i]) > 0.05) moving = true;
        }
        var sx = seenX[i];
        var sy = seenY[i];
        var near = Math.hypot(sx - cx, sy - cy);
        var goal = fieldAngle(s, i, sx, sy);
        var rest = rests[i];
        if (reachOut > 0) {
          var t = clamp((reachOut - near) / Math.max(1, reachOut - reachIn), 0, 1);
          goal = rest + wrap(goal - rest, period) * smootherstep(t);
        }
        var shown = 1;
        if (introLive) {
          var local = (introTime - reveal[i] / field.introSpeed) / INTRO_SPIN;
          var progress = smootherstep(clamp(local, 0, 1));
          if (local < 1) introBusy = true;
          goal = rest + wrap(goal - rest, period) * progress;
          shown = clamp(local * 2.5, 0, 1);
        }
        if (born) {
          angles[i] = introLive ? rest : goal;
          speeds[i] = 0;
          pending[i] = 0;
        } else if (!stiffness) {
          angles[i] = angles[i] + wrap(goal - angles[i], period);
          speeds[i] = 0;
        } else {
          var angle = angles[i];
          var velocity = speeds[i];
          for (var step = 0; step < steps; step++) {
            velocity += (stiffness * wrap(goal - angle, period) - damping * velocity) * h;
            angle += velocity * h;
          }
          if (Math.abs(velocity) < 0.002 && Math.abs(wrap(goal - angle, period)) < 0.0005) {
            angle += wrap(goal - angle, period);
            velocity = 0;
          } else {
            moving = true;
          }
          if (angle > 40 || angle < -40) angle = wrap(angle, TAU);
          angles[i] = angle;
          speeds[i] = velocity;
        }

        var spin = 0;
        var flash = 0;
        for (var p = 0; p < pulses.length; p++) {
          var pulse = pulses[p];
          var travelled = (clock - pulse.start) * PULSE_SPEED;
          var gap = Math.hypot(cx - pulse.x, cy - pulse.y);
          var plocal = (travelled - gap) / (PULSE_SPEED * PULSE_SPIN);
          if (plocal > 0 && plocal < 1) spin += smootherstep(plocal) * period;
          var band = (travelled - gap - PULSE_SPEED * PULSE_SPIN * 0.5) / 60;
          flash += Math.exp(-band * band) * Math.max(0, 1 - (clock - pulse.start) / pulse.life);
        }

        var emphasis = Math.exp(-(near * near) / (radius * radius)) * shown;
        state[i * 4] = angles[i] + spin;
        state[i * 4 + 1] = emphasis;
        state[i * 4 + 2] = Math.min(1, flash * 0.9) * shown;
        state[i * 4 + 3] = shown;
      }

      if (introLive && !introBusy && clock - introStart > 0.2) introLive = false;
      if (Math.abs(px - target.x) + Math.abs(py - target.y) > 0.05) moving = true;

      gl.bindFramebuffer(gl.FRAMEBUFFER, null);
      gl.viewport(0, 0, canvas.width, canvas.height);
      gl.clearColor(0, 0, 0, 0);
      gl.clear(gl.COLOR_BUFFER_BIT);
      if (count && field.view) {
        var u = program.uniforms;
        gl.useProgram(program.program);
        gl.uniformMatrix3fv(u.uView, true, field.view.forward);
        gl.uniform2f(u.uCanvas, field.width + field.pad * 2, field.height + field.pad * 2);
        gl.uniform2f(u.uOffset, field.pad, field.pad);
        gl.uniform2f(u.uLine, field.length / 2, field.thickness / 2);
        gl.uniform1f(u.uStretch, s.stretch);
        gl.uniform1f(u.uHead, s.shape === 'needle' ? 0.16 : s.shape === 'arrow' ? 0.32 : 0);
        gl.uniform1f(u.uPad, field.edgePad);
        gl.uniform1f(u.uFar, field.fill ? FAR : 1e6);
        gl.uniform3fv(u.uColor, s.color);
        gl.uniform3fv(u.uAccent, s.accent);
        gl.uniform1f(u.uAccentMix, s.accentMix);
        gl.uniform1f(u.uOpacity, 1);
        gl.uniform1f(u.uFade, s.fade);
        gl.uniform1i(u.uShape, SHAPES[s.shape]);
        gl.uniform1f(u.uRainbow, s.rainbow ? 1 : 0);
        gl.uniform1f(u.uTone, s.tone);
        gl.uniform1f(u.uPeriod, period);
        gl.uniform2f(u.uPixels, canvas.width, canvas.height);
        gl.uniform2f(u.uEdge, s.edgeFade * 0.34 * field.width, s.edgeFade * 0.44 * field.height);
        gl.bindVertexArray(vao);
        gl.bindBuffer(gl.ARRAY_BUFFER, stateBuffer);
        gl.bufferSubData(gl.ARRAY_BUFFER, 0, state);
        gl.drawArraysInstanced(gl.TRIANGLE_STRIP, 0, 4, count);
      }

      var busy = moving || introLive || pulses.length > 0 || wandering;
      if (busy && visible && pageVisible) raf = requestAnimationFrame(frame);
    };

    var wake = function () {
      if (raf || lost || !visible || !pageVisible) return;
      last = performance.now();
      raf = requestAnimationFrame(frame);
    };

    var toPlane = function (clientX, clientY) {
      if (!field.view) return null;
      var rect = container.getBoundingClientRect();
      var pt = apply(field.view.inverse, clientX - rect.left, clientY - rect.top);
      if (pt[2] <= 0) return null;
      var inside = clientX >= rect.left && clientX <= rect.right && clientY >= rect.top && clientY <= rect.bottom;
      return { x: pt[0], y: pt[1], inside: inside };
    };

    var onPointerMove = function (event) {
      var spot = toPlane(event.clientX, event.clientY);
      if (!spot) return;
      var now = performance.now();
      var dt = Math.max(1, now - pointer.time) / 1000;
      if (pointer.seen && dt < 0.2) {
        pointer.vx = pointer.vx * 0.6 + ((spot.x - pointer.x) / dt) * 0.4;
        pointer.vy = pointer.vy * 0.6 + ((spot.y - pointer.y) / dt) * 0.4;
      }
      pointer.time = now;
      pointer.x = spot.x;
      pointer.y = spot.y;
      pointer.seen = true;
      pointer.inside = spot.inside;
      if (spot.inside) pointer.away = 0;
      wake();
    };

    var onPointerDown = function (event) {
      onPointerMove(event);
      var s = settings;
      if (!s.clickPulse || reduced || !count) return;
      var spot = toPlane(event.clientX, event.clientY);
      if (!spot) return;
      var inside = field.fill
        ? spot.inside
        : Math.abs(spot.x) <= field.width / 2 && Math.abs(spot.y) <= field.height / 2;
      if (!inside) return;
      var minX = field.bounds[0], minY = field.bounds[1], maxX = field.bounds[2], maxY = field.bounds[3];
      var farthest = Math.max(
        Math.hypot(spot.x - minX, spot.y - minY),
        Math.hypot(spot.x - maxX, spot.y - minY),
        Math.hypot(spot.x - minX, spot.y - maxY),
        Math.hypot(spot.x - maxX, spot.y - maxY)
      );
      pulses.push({
        x: spot.x,
        y: spot.y,
        start: clock,
        life: Math.min(6, farthest / PULSE_SPEED + PULSE_SPIN + 0.1)
      });
      if (pulses.length > 6) pulses.shift();
      wake();
    };

    var onLeave = function () {
      pointer.inside = false;
      wake();
    };

    window.addEventListener('pointermove', onPointerMove, { passive: true });
    window.addEventListener('pointerdown', onPointerDown, { passive: true });
    document.documentElement.addEventListener('pointerleave', onLeave);

    var onLost = function (event) {
      event.preventDefault();
      lost = true;
      cancelAnimationFrame(raf);
      raf = 0;
    };
    var onRestored = function () {
      lost = false;
      dirty = true;
      wake();
    };
    canvas.addEventListener('webglcontextlost', onLost);
    canvas.addEventListener('webglcontextrestored', onRestored);

    var onResize = function () {
      dirty = true;
      wake();
    };
    window.addEventListener('resize', onResize);

    var intersection = new IntersectionObserver(function (entries) {
      visible = entries.some(function (entry) { return entry.isIntersecting; });
      wake();
    });
    intersection.observe(container);

    var onVisibility = function () {
      pageVisible = document.visibilityState !== 'hidden';
      wake();
    };
    document.addEventListener('visibilitychange', onVisibility);

    wake();

    return {
      destroy: function () {
        cancelAnimationFrame(raf);
        intersection.disconnect();
        window.removeEventListener('pointermove', onPointerMove);
        window.removeEventListener('pointerdown', onPointerDown);
        window.removeEventListener('resize', onResize);
        document.documentElement.removeEventListener('pointerleave', onLeave);
        document.removeEventListener('visibilitychange', onVisibility);
        canvas.removeEventListener('webglcontextlost', onLost);
        canvas.removeEventListener('webglcontextrestored', onRestored);
        if (!gl.isContextLost()) {
          gl.deleteBuffer(cornerBuffer);
          gl.deleteBuffer(centerBuffer);
          gl.deleteBuffer(stateBuffer);
          gl.deleteVertexArray(vao);
          gl.deleteProgram(program.program);
        }
      }
    };
  }

  global.initMagnetLines = initMagnetLines;
})(window);
