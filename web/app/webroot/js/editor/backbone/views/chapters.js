// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.ChaptersView = (function(_super) {

  __extends(ChaptersView, _super);

  function ChaptersView() {
    var _this = this;
    this.setNewChapter = function() {
      return ChaptersView.prototype.setNewChapter.apply(_this, arguments);
    };
    this.validateNewChapter = function() {
      return ChaptersView.prototype.validateNewChapter.apply(_this, arguments);
    };
    this.rearrangeChapter = function() {
      return ChaptersView.prototype.rearrangeChapter.apply(_this, arguments);
    };
    this.addChapterView = function(timestamp) {
      return ChaptersView.prototype.addChapterView.apply(_this, arguments);
    };
    return ChaptersView.__super__.constructor.apply(this, arguments);
  }

  ChaptersView.prototype.el = $('.chapters');

  ChaptersView.prototype.editChapterDialog = null;

  ChaptersView.prototype.initialize = function() {
    Bachelor.App.Collections.timestamps.on('add', this.addChapterView);
    Bachelor.App.Collections.timestamps.on('change:status change:chapter', this.rearrangeChapter);
    this.editChapterDialog = this.$el.find('.edit-chapter-dialog');
    return this.initEditChapterDialog();
  };

  ChaptersView.prototype.addChapterView = function(timestamp) {
    var chapterView;
    return chapterView = new Bachelor.Views.ChapterView({
      model: timestamp
    });
  };

  ChaptersView.prototype.rearrangeChapter = function() {
    var _this = this;
    return Bachelor.App.Collections.timestamps.each(function(timestamp) {
      var hasChapter, status;
      status = timestamp.get('status');
      hasChapter = timestamp.get('chapter') != null;
      if (status && hasChapter) {
        return _this.$el.find('ul').append(timestamp.chapterView.render().el);
      } else {
        return timestamp.chapterView.hideChapter();
      }
    });
  };

  ChaptersView.prototype.initEditChapterDialog = function() {
    var _this = this;
    return this.editChapterDialog.dialog({
      modal: true,
      autoOpen: false,
      width: 450,
      buttons: {
        'Edit chapter': function() {
          if (_this.validateNewChapter()) {
            return _this.setNewChapter();
          }
        },
        'Cancel': function() {
          return $(this).dialog('close');
        }
      }
    });
  };

  ChaptersView.prototype.loadEditChapterDialogTemplate = function(editChapterModel) {
    var chapter, template;
    this.editChapterModel = editChapterModel;
    chapter = this.editChapterModel.get('chapter');
    template = _.template(this.$el.find('#editChapter').html(), {
      chapter: chapter
    });
    this.editChapterDialog.html(template);
    return this.editChapterDialog.dialog('open');
  };

  ChaptersView.prototype.validateNewChapter = function() {
    var input;
    input = this.editChapterDialog.find('#chapterName');
    if (input.val().length < 1) {
      input.after("<span class='error-message'>Chapter length must be at least 1 character.</span>");
      return false;
    }
    return true;
  };

  ChaptersView.prototype.setNewChapter = function() {
    var newChapter;
    newChapter = this.editChapterDialog.find('#chapterName').val();
    this.editChapterModel.set('chapter', newChapter);
    return this.editChapterDialog.dialog('close');
  };

  return ChaptersView;

})(Backbone.View);
