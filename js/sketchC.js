/**
 * SKETCHC
 * /js/sketchC.js
 * goes with /o/feedback/indexC.html
 *
 * Created by Mike Sperone on 9/22/15 - 10/1/15
 */
var mouseH_speroneGlobal;   // special speroneGlobal to avoid collision with libs and/or other scripts
var mouseV_speroneGlobal;
var frontFeedback_speroneGlobal;
var centerX_speroneGlobal;
var centerY_speroneGlobal;

function setup() {
    createCanvas(windowWidth, windowHeight);
    centerX_speroneGlobal = windowWidth/2;
    centerY_speroneGlobal = windowHeight/2;
    loadComments(width, height);
}

function draw() {
    mouseH_speroneGlobal = mouseX-(width/2);
    mouseV_speroneGlobal = mouseY-(height/2);
}

function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
    centerX_speroneGlobal = windowWidth/2;
    centerY_speroneGlobal = windowHeight/2;
}


function loadFeedbacks(wdt, hgt) {
    var type = browser();
    $.ajax({
        url: 'loadFeedbackVideos.php?type='+type,
        type: "POST"
    }).done(function(data) {
            var feedbackArray = [];
            var JparsedData = JSON.parse(data);     // JparsedData is JSON parsed data
            var dataLength = JparsedData.length;    // the length of this data ^^
            //var commentData = loadComments();
            placeFeedbacks(feedbackArray, JparsedData, dataLength, wdt, hgt);  // add commentData when loadComments
        }
    );
}

function loadComments(wdt, hgt) {
    $.ajax({
        url: 'loadComments.php',
        type: "POST"
    }).done(function(data) {
            var feedbackArray = [];
            var namesAndComments = JSON.parse(data);
            var dataLength = namesAndComments.length;
            placeFeedbacks(feedbackArray, namesAndComments, dataLength, wdt, hgt);
        }
    );
}

function placeFeedbacks(fbAr, Jdata, length, wdt, hgt) {

    var type = browser();

    for (var i = 0; i < length; i++) {
        var comment = Jdata[i]['comment'];
        var path = type+"/"+Jdata[i]['filename'];
        var object;
        var szX;
        var szY;
        var val;

        if (i === length - 1) {
            val = 5;
        } else {
            var layer = i/3;
            val = layer | 0;
        }

        switch (val) {
            case (0):
                object = new Feedback(path, 'rowFive', comment);
                szX = 100;
                szY = 75;
                object.position(random(0 - szX / 2, wdt - szX / 2), random(0 - szY / 2, hgt - szY / 2));
                break;
            case (1):
                object = new Feedback(path, 'rowFour', comment);
                szX = 120;
                szY = 90;
                object.position(random(0 - szX / 2, wdt - szX / 2), random(0 - szY / 2, hgt - szY / 2));
                break;
            case (2):
                object = new Feedback(path, 'rowThree', comment);
                szX = 160;
                szY = 120;
                object.position(random(0 - szX / 2, wdt - szX / 2), random(0 - szY / 2, hgt - szY / 2));
                break;
            case (3):
                object = new Feedback(path, 'rowTwo', comment);
                szX = 240;
                szY = 180;
                object.position(random(0 - szX / 2, wdt - szX / 2), random(0 - szY / 2, hgt - szY / 2));
                break;
            case (4):
                object = new Feedback(path, 'rowOne', comment);
                szX = 320;
                szY = 240;
                object.position(random(0 - szX / 2, wdt - szX / 2), random(0 - szY / 2, hgt - szY / 2));
                break;
            case (5):
                object = new Feedback(path, 'frontRow', comment);
                szX = 480;
                szY = 360;
                object.position(centerX_speroneGlobal - (szX / 2), centerY_speroneGlobal - (szY / 2)+50);
                frontFeedback_speroneGlobal = object;
                break;
        }
        fbAr.push(object);
    }
    displayFeedbacks(fbAr);
}

function displayFeedbacks(fbA) {
    for (var x = 0; x <= (fbA.length-1); x++) {     //length-1 because count goes 0 to x
        fbA[x].display();
    }
}

function Feedback(source, classy, cmnt) {
    var that = this;
    this.src = "https://onceonly.org/o/feedback/videos/"+source;
    this.cls = classy;
    this.xPos = 0;
    this.yPos = 0;
    this.w = 320;
    this.h = 240;
    if (cmnt) {
        this.comment = "<div class='video-comment'><p class='actual-comment hide'>" + cmnt + "</p></div><img class='comment-icon' src='https://onceonly.org/o/image/png/comment.png' width='5%' height='5%' >";
    } else {
        this.comment = "";
    }

    //places the initial location of the object on the screen
    this.position = function(x, y) {
        that.xPos = x;
        that.yPos = y;
    };

    //displays the object
    this.display = function() {
        var v = createVideo(that.src);
        var c = createDiv(that.comment);
        v.class("videos");
        c.class("comments");
        var wrapper = createDiv("");
        wrapper.child(v);
        wrapper.child(c);
        wrapper.position(that.xPos, that.yPos);
        wrapper.class(that.cls);


        if (that.comment) {
            $(c.elt).find(".comment-icon").click(function() {
                    $(c.elt).find("p.actual-comment").toggleClass("hide");
                });
        }
        c.mouseClicked(
            function() {
                var front = $(".frontRow");

                if ($(wrapper.elt)[0] != front[0])
                {
                    front.find("p.actual-comment").addClass("hide");  //close comment if it is open
                    // move front to this
                    frontFeedback_speroneGlobal.position(that.xPos, that.yPos);
                    front.css({"top": that.yPos + "px", "left": that.xPos + "px"});
                    front.toggleClass('frontRow ' + that.cls);
                    frontFeedback_speroneGlobal.cls = that.cls;

                    // move this to front
                    $(wrapper.elt).removeClass("focus");
                    $(wrapper.elt).toggleClass(that.cls + ' frontRow');
                    var hPos = (centerY_speroneGlobal - 130);   // - 180 (for width/2) + 50 (to clear the menu)
                    var wPos = (centerX_speroneGlobal - 240);
                    that.position(wPos, hPos);
                    $(wrapper.elt).css({"top": hPos + "px", "left": wPos + "px"});
                    frontFeedback_speroneGlobal = that;
                }

            }
        );
        c.mouseOver(
            function() {
                v.stop();
                v.play();
                //z-index to front and remove blur/grayscale (focus)
                $(wrapper.elt).addClass("focus");

            }
        );
        c.mouseOut(
            function() {
                //z-index and blur/gray restore (unfocus)
                $(wrapper.elt).removeClass("focus");
            }
        );
    };
}

function mouseMoved() {
    var a = 64;
    var b = 32;
    var c = 24;
    var d = 16;
    var e = 8;

    var mouseOneH = mouseH_speroneGlobal/a;
    var mouseOneV = mouseV_speroneGlobal/a;
    $('.rowOne').css({

        "-webkit-transform":"translate("+mouseOneH+"px, "+mouseOneV+"px)",
        "-moz-transform":"translate("+mouseOneH+"px, "+mouseOneV+"px)",
        "-ms-transform":"translate("+mouseOneH+"px, "+mouseOneV+"px)",
        "-o-transform":"translate("+mouseOneH+"px, "+mouseOneV+"px)",
        "transform":"translate("+mouseOneH+"px, "+mouseOneV+"px)"
    });

    var mouseTwoH = mouseH_speroneGlobal/b;
    var mouseTwoV = mouseV_speroneGlobal/b;
    $('.rowTwo').css({
        "-webkit-transform":"translate("+mouseTwoH+"px, "+mouseTwoV+"px)",
        "-moz-transform":"translate("+mouseTwoH+"px, "+mouseTwoV+"px)",
        "-ms-transform":"translate("+mouseTwoH+"px, "+mouseTwoV+"px)",
        "-o-transform":"translate("+mouseTwoH+"px, "+mouseTwoV+"px)",
        "transform":"translate("+mouseTwoH+"px, "+mouseTwoV+"px)"
    });

    var mouseThreeH = mouseH_speroneGlobal/c;
    var mouseThreeV = mouseV_speroneGlobal/c;
    $('.rowThree').css({
        "-webkit-transform":"translate("+mouseThreeH+"px, "+mouseThreeV+"px)",
        "-moz-transform":"translate("+mouseThreeH+"px, "+mouseThreeV+"px)",
        "-ms-transform":"translate("+mouseThreeH+"px, "+mouseThreeV+"px)",
        "-o-transform":"translate("+mouseThreeH+"px, "+mouseThreeV+"px)",
        "transform":"translate("+mouseThreeH+"px, "+mouseThreeV+"px)"
    });

    var mouseFourH = mouseH_speroneGlobal/d;
    var mouseFourV = mouseV_speroneGlobal/d;
    $('.rowFour').css({
        "-webkit-transform":"translate("+mouseFourH+"px, "+mouseFourV+"px)",
        "-moz-transform":"translate("+mouseFourH+"px, "+mouseFourV+"px)",
        "-ms-transform":"translate("+mouseFourH+"px, "+mouseFourV+"px)",
        "-o-transform":"translate("+mouseFourH+"px, "+mouseFourV+"px)",
        "transform":"translate("+mouseFourH+"px, "+mouseFourV+"px)"
    });

    var mouseFiveH = mouseH_speroneGlobal/e;
    var mouseFiveV = mouseV_speroneGlobal/e;
    $('.rowFive').css({
        "-webkit-transform":"translate("+mouseFiveH+"px, "+mouseFiveV+"px)",
        "-moz-transform":"translate("+mouseFiveH+"px, "+mouseFiveV+"px)",
        "-ms-transform":"translate("+mouseFiveH+"px, "+mouseFiveV+"px)",
        "-o-transform":"translate("+mouseFiveH+"px, "+mouseFiveV+"px)",
        "transform":"translate("+mouseFiveH+"px, "+mouseFiveV+"px)"
    });

}

var browser = function() {
    var filetype;

    // Return cached result if avalible, else get result then cache it.
    if (browser.prototype._cachedResult) {
        return browser.prototype._cachedResult;
    }

    var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
    var isFirefox = typeof InstallTrigger !== 'undefined';// Firefox 1.0+
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    // At least Safari 3+: "[object HTMLElementConstructor]"
    var isChrome = !!window.chrome && !isOpera;// Chrome 1+
    var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6

    var browserType = isOpera ? 'Opera' :
        isFirefox ? 'Firefox' :
            isSafari ? 'Safari' :
                isChrome ? 'Chrome' :
                    isIE ? 'IE' :
                        '';
    switch (browserType) {
        case 'Opera':
            filetype = "webm";
            break;
        case 'Firefox':
            filetype = "webm";
            break;
        case 'Safari':
            filetype = "mp4";
            break;
        case 'Chrome':
            filetype = "webm";
            break;
        case 'IE':
            filetype = "mp4";
            break;
        default:
            filetype = "mp4";
            break;
    }
    return (browser.prototype._cachedResult = filetype);
};