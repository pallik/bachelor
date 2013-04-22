// Generated by CoffeeScript 1.6.1
var root;

root = typeof exports !== "undefined" && exports !== null ? exports : this;

root.pop = null;

$(function() {
  var Lesson, adjustBlocksContainterHeight, handleLessonResult, handlePopcorn, id, lesson;
  Lesson = Backbone.Model.extend({
    urlRoot: app.url + "/lessons"
  });
  id = app.request.params.pass[0];
  lesson = new Lesson({
    id: id
  });
  /*
         load all lesson data
  */

  lesson.fetch({
    success: function(data) {
      return handleLessonResult(data.toJSON());
    }
  });
  /*
  	  hande result from ajax
  */

  handleLessonResult = function(data) {
    console.log(data);
    handlePopcorn(data.lesson);
    return adjustBlocksContainterHeight();
  };
  /*
  		create popcorn instance
         add popcorn elements
  		on time update thumbnails-scroller and chapters
  */

  handlePopcorn = function(lesson) {
    root.pop = new Pop(lesson.Attachment.url);
    root.pop.addPopcornElements(lesson.Block);
    return root.pop.onTimeUpdate();
  };
  /*
         sets div.blocks height
  */

  return adjustBlocksContainterHeight = function() {
    var blocksContainerHeight, divBlocks, maxYposition;
    divBlocks = $('.blocks');
    maxYposition = 0;
    $('.block').each(function() {
      var height, offsetTop, positionY;
      offsetTop = $(this).offset().top;
      height = $(this).height();
      positionY = offsetTop + height;
      if (positionY > maxYposition) {
        return maxYposition = positionY;
      }
    });
    blocksContainerHeight = maxYposition - divBlocks.offset().top;
    return divBlocks.height(blocksContainerHeight);
  };
});
