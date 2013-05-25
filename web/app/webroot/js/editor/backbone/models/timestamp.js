// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Models.Timestamp = (function(_super) {

  __extends(Timestamp, _super);

  function Timestamp() {
    var _this = this;
    this.highlightTimestamp = function() {
      return Timestamp.prototype.highlightTimestamp.apply(_this, arguments);
    };
    this.setTimestampFalse = function() {
      return Timestamp.prototype.setTimestampFalse.apply(_this, arguments);
    };
    this.setChapter = function() {
      return Timestamp.prototype.setChapter.apply(_this, arguments);
    };
    return Timestamp.__super__.constructor.apply(this, arguments);
  }

  Timestamp.prototype.defaults = {
    id: null,
    status: false,
    timing: false,
    highlight: false,
    start: 0,
    end: 0,
    chapter: null,
    blockCid: null,
    block_id: null
  };

  Timestamp.prototype.isSet = function() {
    return this.get('status');
  };

  Timestamp.prototype.setChapterNull = function() {
    return this.set('chapter', null);
  };

  Timestamp.prototype.setChapter = function() {
    return Bachelor.App.Views.chaptersView.loadEditChapterDialogTemplate(this);
  };

  Timestamp.prototype.setTimestampFalse = function() {
    this.set('status', false);
    return Backbone.Events.trigger('renderAllTimestamps');
  };

  Timestamp.prototype.highlightTimestamp = function() {
    return this.view.toggleDraggable();
  };

  return Timestamp;

})(Backbone.Model);

Bachelor.Collections.Timestamps = (function(_super) {

  __extends(Timestamps, _super);

  function Timestamps() {
    return Timestamps.__super__.constructor.apply(this, arguments);
  }

  Timestamps.prototype.model = Bachelor.Models.Timestamp;

  Timestamps.prototype.url = "" + app.url + "/admin/timestamps";

  Timestamps.prototype.comparator = function(m1, m2) {
    var name1, name2, start1, start2, status1, status2;
    status1 = m1.get('status');
    status2 = m2.get('status');
    if (!status1 && !status2) {
      name1 = parseInt(m1.get('Attachment').name);
      name2 = parseInt(m2.get('Attachment').name);
      if (isNaN(name1)) {
        name1 = 0;
      }
      if (isNaN(name2)) {
        name2 = 0;
      }
      if (name1 < name2) {
        return -1;
      }
      if (name1 > name2) {
        return 1;
      }
      return 0;
    } else if (!status1 && status2) {
      return -1;
    } else if (status1 && !status2) {
      return 1;
    } else if (status1 && status2) {
      start1 = parseInt(m1.get('start'));
      start2 = parseInt(m2.get('start'));
      if (start1 < start2) {
        return -1;
      }
      if (start1 === start2) {
        return 0;
      }
      if (start1 > start2) {
        return 1;
      }
    }
  };

  return Timestamps;

})(Backbone.Collection);
