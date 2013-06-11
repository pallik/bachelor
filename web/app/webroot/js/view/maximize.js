// Generated by CoffeeScript 1.6.1

$(function() {
  var $globalRestore, close, maximize, minimizeAll, restoreAll;
  $globalRestore = $('.global-restore');
  /*
         handle on click maximize icon
  */

  $('.maximize').click(function(e) {
    var $block, $otherBlocks;
    e.preventDefault();
    $block = $(this).closest('.block');
    $otherBlocks = $('.block').not($block);
    maximize($block);
    return minimizeAll($otherBlocks);
  });
  /*
         on click close button
  */

  $('.close').click(function(e) {
    var $block;
    e.preventDefault();
    $block = $(this).closest('.block');
    return close($block);
  });
  /*
  		restore button on video, cause ESC not working
  */

  $('.restore').click(function(e) {
    e.preventDefault();
    return restoreAll();
  });
  /*
         restore all blocks when esc pressed
  */

  $(document).keyup(function(e) {
    var KEYCODE_ESC;
    KEYCODE_ESC = 27;
    if (e.keyCode === KEYCODE_ESC) {
      return restoreAll();
    }
  });
  /*
         when block changes its size, update img max dimensions
  */

  $('.block').resize(function() {
    var blockHeight, blockWidth, images, maximized, minimized, style;
    blockWidth = $(this).width();
    blockHeight = $(this).height();
    images = $(this).find('.popcorn-container img');
    maximized = $(this).hasClass('maximized');
    minimized = $(this).hasClass('minimized');
    if (!maximized && !minimized) {
      $('.blocks').trigger('adjustBlocksContainerHeight');
    }
    style = {
      maxWidth: blockWidth + 'px',
      maxHeight: blockHeight + 'px'
    };
    return images.css(style);
  });
  /*
         set default img max dimensions
  */

  window.onload = function() {
    return $('.block').trigger('resize');
  };
  /*
         maximize block
  */

  maximize = function($block) {
    var $jcarouselContainer, $restoreIcon, $tools, style;
    $jcarouselContainer = $block.find('.jcarousel-container');
    $tools = $block.find('.tools');
    $restoreIcon = $block.find('.restore-icon');
    style = {
      position: 'fixed',
      top: 0,
      left: 0,
      width: '100%',
      height: '100%',
      'z-index': 3
    };
    $block.removeAttr('style').css(style);
    $block.removeClass('minimized');
    $block.addClass('maximized');
    $jcarouselContainer.show();
    $tools.hide();
    $restoreIcon.show();
    $globalRestore.hide();
    $('body').css('overflow', 'hidden');
    return $block.trigger('resize');
  };
  /*
         minimize block
  */

  minimizeAll = function($blocks) {
    return $blocks.each(function(i) {
      var $jcarouselContainer, $restoreIcon, $tools, rightPosition, style;
      $jcarouselContainer = $(this).find('.jcarousel-container');
      $tools = $(this).find('.tools');
      $restoreIcon = $(this).find('.restore-icon');
      rightPosition = 100 + i * 110;
      style = {
        position: 'fixed',
        width: '100px',
        height: '100px',
        top: 'auto',
        left: 'auto',
        bottom: '50px',
        right: rightPosition + 'px'
      };
      $(this).removeAttr('style').css(style);
      $(this).removeClass('maximized');
      $(this).addClass('minimized');
      $jcarouselContainer.hide();
      $tools.show();
      $restoreIcon.hide();
      return $(this).trigger('resize');
    });
  };
  /*
         restore default position
  */

  restoreAll = function() {
    $globalRestore.show();
    $('body').css('overflow', 'auto');
    return $('.block').each(function() {
      var $jcarouselContainer, $restoreIcon, $tools, style;
      style = $(this).data('style');
      $tools = $(this).find('.tools');
      $restoreIcon = $(this).find('.restore-icon');
      $jcarouselContainer = $(this).find('.jcarousel-container');
      $(this).removeAttr('style').attr('style', style);
      $(this).removeClass('maximized minimized');
      $tools.show();
      $restoreIcon.hide();
      $jcarouselContainer.show();
      return $(this).trigger('resize');
    });
  };
  /*
         hide block
  */

  return close = function($block) {
    return $block.hide();
  };
});
