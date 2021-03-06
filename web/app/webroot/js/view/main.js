// Generated by CoffeeScript 1.6.1
var root;

root = typeof exports !== "undefined" && exports !== null ? exports : this;

root.pop = null;

$(function() {
  var Lesson, handleLessonResult, handlePopcorn, id, lesson;
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
    handlePopcorn(data.lesson);
    return $('.blocks').trigger('adjustBlocksContainerHeight');
  };
  /*
  		create popcorn instance
         add popcorn elements
  		on time update thumbnails-scroller and chapters
  */

  return handlePopcorn = function(lesson) {
    root.pop = new Pop(lesson.Attachment.url);
    root.pop.addPopcornElements(lesson.Block);
    return root.pop.onTimeUpdate();
  };
});
