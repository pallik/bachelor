// Generated by CoffeeScript 1.6.1

$(function() {
  var $blocks, $jcarouselContainers, $jcarousels, $li, hideScroller, scrolling, showScroller;
  $li = $('.jcarousel li');
  $jcarousels = $('.jcarousel');
  $jcarouselContainers = $('.jcarousel-container');
  $blocks = $('.block');
  $jcarousels.jcarousel({
    vertical: 'true'
  });
  /*
         click on li
  */

  $li.click(function() {
    var time;
    time = $(this).data('start');
    return root.pop.jumpTo(time);
  });
  /*
         highlight thumbnail
         set it in the middle of scroller
  */

  $li.on('timeupdate', function(event, time) {
    var $jcarousel, aboveElementsCount, currentIndex, end, fullyVisible, fullyVisibleCount, indexShouldBeOnTop, mouseenter, start;
    start = $(this).data('start');
    end = $(this).data('end');
    time = Math.floor(time);
    if (time >= start && time < end) {
      if (!$(this).hasClass('active')) {
        $(this).addClass('active');
      }
      $jcarousel = $(this).closest('.jcarousel');
      mouseenter = $jcarousel.data('mouseenter');
      fullyVisible = $jcarousel.jcarousel('fullyvisible');
      fullyVisibleCount = fullyVisible.length;
      aboveElementsCount = Math.ceil(fullyVisibleCount / 2) - 1;
      currentIndex = $(this).index();
      indexShouldBeOnTop = currentIndex - aboveElementsCount;
      if (indexShouldBeOnTop < 0) {
        indexShouldBeOnTop = currentIndex;
      }
      if (!mouseenter) {
        return $jcarousel.jcarousel('scroll', indexShouldBeOnTop);
      }
    } else {
      return $(this).removeClass('active');
    }
  });
  /*
         on mouseenter jcarousel
  */

  $jcarouselContainers.mouseenter(function() {
    return $(this).find('.jcarousel').data('mouseenter', true);
  });
  /*
         on mouseleave jcarousel
  */

  $jcarouselContainers.mouseleave(function() {
    $(this).find('.jcarousel').data('mouseenter', false);
    return hideScroller($(this));
  });
  /*
         toggles jcarousel-container visibility
  */

  $blocks.mousemove(function(e) {
    var $jcarouselContainer, animating, blockOffsetLeft, blockRightBorder, blockWidth, isAnimating, isVisible, scrollerTotalWidth, triggerRange, visible;
    blockWidth = $(this).width();
    blockOffsetLeft = $(this).offset().left;
    blockRightBorder = blockWidth + blockOffsetLeft;
    $jcarouselContainer = $(this).find('.jcarousel-container');
    scrollerTotalWidth = $jcarouselContainer.outerWidth(true);
    triggerRange = scrollerTotalWidth / 2;
    visible = $jcarouselContainer.data('visible');
    isVisible = (visible != null) && visible === true;
    animating = $jcarouselContainer.data('animating');
    isAnimating = (animating != null) && animating === true;
    if (e.pageX >= blockRightBorder - triggerRange && !isVisible && !isAnimating) {
      return showScroller($jcarouselContainer);
    } else if (e.pageX < blockRightBorder - scrollerTotalWidth && !isAnimating && isVisible) {
      return hideScroller($jcarouselContainer);
    }
  });
  /*
         show scroller - jcarousel container
  */

  showScroller = function($jcarouselContainer) {
    $jcarouselContainer.data('animating', true);
    return $jcarouselContainer.animate({
      right: 0
    }, function() {
      $(this).data('visible', true);
      return $(this).data('animating', false);
    });
  };
  /*
         hide scroller - jcarousel container
  */

  hideScroller = function($jcarouselContainer) {
    var scrollerTotalWidth;
    scrollerTotalWidth = $jcarouselContainer.outerWidth(true);
    $jcarouselContainer.data('animating', true);
    return $jcarouselContainer.animate({
      right: -scrollerTotalWidth
    }, function() {
      $(this).data('animating', false);
      return $(this).data('visible', false);
    });
  };
  /*
         mousewheel on scroller dont scroll page
  */

  $jcarouselContainers.bind('mousewheel DOMMouseScroll', function(e) {
    var scrollTo;
    scrollTo = null;
    if (e.type === 'mousewheel') {
      scrollTo = e.originalEvent.wheelDelta * -1;
    } else if (e.type === 'DOMMouseScroll') {
      scrollTo = 40 * e.originalEvent.detail;
    }
    if (scrollTo) {
      e.preventDefault();
      $(this).scrollTop(scrollTo + $(this).scrollTop());
      return scrolling(-scrollTo);
    }
  });
  /*
  		scrolling scroller with mousewheel
         forbid scroll outside of ul range
  */

  return scrolling = function(px) {
    var $curentScroller, $ul, adjustedTop, currentTop, totalUlHeight, visibleUlHeight;
    $curentScroller = $jcarousels.filter(function() {
      return $(this).data('mouseenter') === true;
    });
    $ul = $curentScroller.find('ul');
    currentTop = parseInt($ul.css('top').slice(0, -2));
    adjustedTop = currentTop + px;
    if (adjustedTop > 0) {
      adjustedTop = 0;
    }
    visibleUlHeight = $curentScroller.height();
    totalUlHeight = 0;
    $ul.children().each(function() {
      return totalUlHeight += $(this).outerHeight(true);
    });
    if (adjustedTop - visibleUlHeight < -totalUlHeight) {
      adjustedTop = -totalUlHeight + visibleUlHeight;
    }
    return $ul.css('top', adjustedTop + 'px');
  };
});
