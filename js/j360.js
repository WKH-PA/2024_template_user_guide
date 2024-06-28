function init(number, arr_anh, width, height, play) {
 var tgxd360;
 tgxd360 = $('.js_load_360').ThreeSixty({
  totalFrames: number,
  arr_anh: arr_anh,
  endFrame: number,
  currentFrame: 1,
  imgList: '.threesixty_images',
  progress: '.spinner',
  ext: '.jpg',
  height: height,
  width: width,
  autoplayDirection: 0,
  autoplay: 1,
  navigation: true
 });
 if (play == 1) {
  tgxd360.play();
 }
 $('.custom_previous').bind('click', function(e) {
  tgxd360.previous();
 });
 $('.custom_next').bind('click', function(e) {
  tgxd360.next();
 });
 $('.custom_play').bind('click', function(e) {
  tgxd360.play();
 });
 $('.custom_stop').bind('click', function(e) {
  tgxd360.stop();
 });
}(function(n) {
 "use strict";
 n.ThreeSixty = function(t, i) {
  var u = this,
   r, f = [];
  u.$el = n(t);
  u.el = t;
  u.$el.data("ThreeSixty", u);
  u.init = function() {
   r = n.extend({}, n.ThreeSixty.defaultOptions, i);
   r.disableSpin && (r.currentFrame = 1, r.endFrame = 1);
   u.initProgress();
   u.loadImages();
   u.$el.on("mousedown touchstart", function() {
    u.stop()
   });
   u.$el.on("mouseup touchend", function() {
    u.play()
   })
  };
  u.resize = function() {};
  u.initProgress = function() {
   u.$el.css({
    width: r.width + "px",
    height: r.height + "px",
    "background-image": "none !important"
   });
   r.styles && u.$el.css(r.styles);
   u.responsive();
   u.$el.find(r.progress).css({
    marginTop: r.height / 2 - 15 + "px"
   });
   u.$el.find(r.progress).fadeIn("slow");
   u.$el.find(r.imgList).show("slow")
  };
  u.loadImages = function() {
   var t, e, i, o;
   t = document.createElement("li");
   o = r.zeroBased ? 0 : 1;
   e = r.arr_anh[0];
   r.arr_anh.shift();

   i = n("<img>").attr("src", e).addClass("previous-image").appendTo(t);
   f.push(i);
   u.$el.find(r.imgList).append(t);
   n(i).load(function() {
    u.imageLoaded()
   })
  };
  u.imageLoaded = function() {
   r.loadedImages += 1;
   n(r.progress + " span").text(Math.floor(r.loadedImages / r.totalFrames * 100) + "%");
   r.loadedImages >= r.totalFrames ? (r.disableSpin && f[0].removeClass("previous-image").addClass("current-image"), n(r.progress).fadeOut("slow", function() {
    n(this).hide();
    u.showImages();
    u.showNavigation()
   })) : u.loadImages()
  };
  u.showImages = function() {
   u.$el.find(".txtC").fadeIn();
   u.$el.find(r.imgList).fadeIn();
   u.ready = !0;
   r.ready = !0;
   r.drag && u.initEvents();
   u.refresh();
   u.initPlugins();
   r.onReady();
   setTimeout(function() {
    u.responsive()
   }, 50)
  };
  u.initPlugins = function() {
   n.each(r.plugins, function(t, i) {
    if (typeof n[i] == "function") n[i].call(u, u.$el, r);
    else throw new Error(i + " not available.");
   })
  };
  u.showNavigation = function() {
   if (r.navigation && !r.navigation_init) {
    var t, i, f, e;
    t = n("<div/>").attr("class", "nav_bar");
    i = n("<a/>").attr({
     href: "#",
     "class": "nav_bar_next"
    }).html("next");
    f = n("<a/>").attr({
     href: "#",
     "class": "nav_bar_previous"
    }).html("previous");
    e = n("<a/>").attr({
     href: "#",
     "class": "nav_bar_play"
    }).html("play");
    t.append(f);
    t.append(e);
    t.append(i);
    u.$el.prepend(t);
    f.bind("mousedown touchstart", u.next);
    i.bind("mousedown touchstart", u.previous);
    e.bind("mousedown touchstart", u.play_stop);
    r.navigation_init = !0
   }
  };
  u.play_stop = function(t) {
   t.preventDefault();
   r.autoplay ? (r.autoplay = !1, n(t.currentTarget).removeClass("nav_bar_stop").addClass("nav_bar_play"), clearInterval(r.play), r.play = null) : (r.autoplay = !0, r.play = setInterval(u.moveToNextFrame, r.playSpeed), n(t.currentTarget).removeClass("nav_bar_play").addClass("nav_bar_stop"))
  };
  u.next = function(n) {
   n && n.preventDefault();
   r.endFrame -= 5;
   u.refresh()
  };
  u.previous = function(n) {
   n && n.preventDefault();
   r.endFrame += 5;
   u.refresh()
  };
  u.play = function(n) {
   var t = n || r.playSpeed;
   r.autoplay || (r.autoplay = !0, r.play = setInterval(u.moveToNextFrame, t))
  };
  u.stop = function() {
   r.autoplay && (r.autoplay = !1, clearInterval(r.play), r.play = null)
  };
  u.moveToNextFrame = function() {
   r.autoplayDirection === 1 ? r.endFrame -= 1 : r.endFrame += 1;
   u.refresh()
  };
  u.gotoAndPlay = function(n) {
   var i;
   if (r.disableWrap) r.endFrame = n, u.refresh();
   else {
    i = Math.ceil(r.endFrame / r.totalFrames);
    i === 0 && (i = 1);
    var t = i > 1 ? r.endFrame - (i - 1) * r.totalFrames : r.endFrame,
     f = r.totalFrames - t,
     e = 0;
    e = n - t > 0 ? n - t < t + (r.totalFrames - n) ? r.endFrame + (n - t) : r.endFrame - (t + (r.totalFrames - n)) : t - n < f + n ? r.endFrame - (t - n) : r.endFrame + (f + n);
    t !== n && (r.endFrame = e, u.refresh())
   }
  };
  u.initEvents = function() {
   u.$el.bind("mousedown touchstart touchmove touchend mousemove click", function(n) {
    n.preventDefault();
    n.type === "mousedown" && n.which === 1 || n.type === "touchstart" ? (r.pointerStartPosX = u.getPointerEvent(n).pageX, r.dragging = !0) : n.type === "touchmove" ? u.trackPointer(n) : n.type === "touchend" && (r.dragging = !1)
   });
   n(document).bind("mouseup", function() {
    r.dragging = !1;
    n(this).css("cursor", "none")
   });
   n(window).bind("resize", function() {
    u.responsive()
   });
   n(document).bind("mousemove", function(n) {
    r.dragging ? (n.preventDefault(), !u.browser.isIE && r.showCursor && u.$el.css("cursor", "url(assets/images/hand_closed.png), auto")) : !u.browser.isIE && r.showCursor && u.$el.css("cursor", "url(assets/images/hand_open.png), auto");
    u.trackPointer(n)
   });
   n(window).bind("resize", function() {
    u.resize()
   })
  };
  u.getPointerEvent = function(n) {
   return n.originalEvent.targetTouches ? n.originalEvent.targetTouches[0] : n
  };
  u.trackPointer = function(n) {
   r.ready && r.dragging && (r.pointerEndPosX = u.getPointerEvent(n).pageX, r.monitorStartTime < (new Date).getTime() - r.monitorInt && (r.pointerDistance = r.pointerEndPosX - r.pointerStartPosX, r.endFrame = r.pointerDistance > 0 ? r.currentFrame - Math.ceil((r.totalFrames - 1) * r.speedMultiplier * (r.pointerDistance / u.$el.width())) : r.currentFrame - Math.floor((r.totalFrames - 1) * r.speedMultiplier * (r.pointerDistance / u.$el.width())), r.disableWrap && (r.endFrame = Math.min(r.totalFrames - (r.zeroBased ? 1 : 0), r.endFrame), r.endFrame = Math.max(r.zeroBased ? 0 : 1, r.endFrame)), u.refresh(), r.monitorStartTime = (new Date).getTime(), r.pointerStartPosX = u.getPointerEvent(n).pageX))
  };
  u.refresh = function() {
   r.ticker === 0 && (r.ticker = setInterval(u.render, Math.round(1e3 / r.framerate)))
  };
  u.render = function() {
   var n;
   r.currentFrame !== r.endFrame ? (n = r.endFrame < r.currentFrame ? Math.floor((r.endFrame - r.currentFrame) * .1) : Math.ceil((r.endFrame - r.currentFrame) * .1), u.hidePreviousFrame(), r.currentFrame += n, u.showCurrentFrame(), u.$el.trigger("frameIndexChanged", [u.getNormalizedCurrentFrame(), r.totalFrames])) : (window.clearInterval(r.ticker), r.ticker = 0)
  };
  u.hidePreviousFrame = function() {
   f[u.getNormalizedCurrentFrame()].removeClass("current-image").addClass("previous-image")
  };
  u.showCurrentFrame = function() {
   f[u.getNormalizedCurrentFrame()].removeClass("previous-image").addClass("current-image")
  };
  u.getNormalizedCurrentFrame = function() {
   var n, t;
   return r.disableWrap ? (n = Math.min(r.currentFrame, r.totalFrames - (r.zeroBased ? 1 : 0)), t = Math.min(r.endFrame, r.totalFrames - (r.zeroBased ? 1 : 0)), n = Math.max(n, r.zeroBased ? 0 : 1), t = Math.max(t, r.zeroBased ? 0 : 1), r.currentFrame = n, r.endFrame = t) : (n = Math.ceil(r.currentFrame % r.totalFrames), n < 0 && (n += r.totalFrames - (r.zeroBased ? 1 : 0))), n
  };
  u.getCurrentFrame = function() {
   return r.currentFrame
  };
  u.responsive = function() {
   r.responsive && u.$el.css({
    height: u.$el.find(".current-image").first().css("height"),
    width: "100%"
   })
  };
  u.zeroPad = function(n) {
   function i(n, t) {
    var i = n.toString();
    if (r.zeroPadding)
     while (i.length < t) i = "0" + i;
    return i
   }
   var u = Math.log(r.totalFrames) / Math.LN10,
    t = 1e3,
    f = Math.round(u * t) / t,
    e = Math.floor(f) + 1;
   return i(n, e)
  };
  u.browser = {};
  u.browser.isIE = function() {
   var n = -1,
    t, i;
   return navigator.appName === "Microsoft Internet Explorer" && (t = navigator.userAgent, i = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})"), i.exec(t) !== null && (n = parseFloat(RegExp.$1))), n !== -1
  };
  u.getConfig = function() {
   return r
  };
  n.ThreeSixty.defaultOptions = {
   dragging: !1,
   ready: !1,
   pointerStartPosX: 0,
   pointerEndPosX: 0,
   pointerDistance: 0,
   monitorStartTime: 0,
   monitorInt: 10,
   ticker: 0,
   speedMultiplier: 10,
   totalFrames: 180,
   currentFrame: 0,
   endFrame: 0,
   loadedImages: 0,
   framerate: 60,
   domains: null,
   domain: "",
   parallel: !1,
   queueAmount: 8,
   idle: 0,
   filePrefix: "",
   ext: "jpg",
   height: 960,
   width: 700,
   styles: {},
   navigation: !1,
   autoplay: !1,
   autoplayDirection: 1,
   disableSpin: !1,
   disableWrap: !1,
   responsive: !1,
   zeroPadding: !1,
   zeroBased: !1,
   plugins: [],
   showCursor: !1,
   drag: !0,
   onReady: function() {},
   imgList: ".threesixty_images",
   imgArray: null,
   playSpeed: 280
  };
  u.init()
 };
 n.fn.ThreeSixty = function(t) {
  return Object.create(new n.ThreeSixty(this, t))
 }
})(jQuery);
typeof Object.create && (Object.create = function(a) {
 "use strict";

 function b() {}
 return b.prototype = a, new b
});
var xhr;
var nameCookieJsScript = 'cookieReffer';