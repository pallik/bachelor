// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.PinView = (function(_super) {

  __extends(PinView, _super);

  function PinView() {
    var _this = this;
    this.updateTime = function() {
      return PinView.prototype.updateTime.apply(_this, arguments);
    };
    this.updateModelOnStopDragging = function(event, ui) {
      return PinView.prototype.updateModelOnStopDragging.apply(_this, arguments);
    };
    this.render = function() {
      return PinView.prototype.render.apply(_this, arguments);
    };
    return PinView.__super__.constructor.apply(this, arguments);
  }

  PinView.prototype.tagName = 'span';

  PinView.prototype.className = 'timeline-pin typcn with-context-menu';

  PinView.prototype.disabledClasses = {
    start: 'typcn-arrow-down-thick',
    end: 'typcn-arrow-up-thick'
  };

  PinView.prototype.enabledClasses = {
    start: 'typcn-arrow-down-outline',
    end: 'typcn-arrow-up-outline'
  };

  PinView.prototype.ratio = null;

  PinView.prototype.events = {
    'click': 'updateTime'
  };

  PinView.prototype.initialize = function() {
    this.side = this.options.side;
    this.$el.addClass(this.side);
    this.$el.addClass(this.disabledClasses[this.side]);
    if (this.side === 'start') {
      this.model.pinStartView = this;
    }
    if (this.side === 'end') {
      this.model.pinEndView = this;
    }
    Backbone.Events.on('durationchange', this.render);
    this.$el.on('setChapter', this.model.setChapter);
    this.$el.on('deleteTimestamp', this.model.setTimestampFalse);
    this.$el.on('highlightTimestamp', this.model.highlightTimestamp);
    this.setContent();
    return this.setDraggable();
  };

  PinView.prototype.render = function() {
    this.setRatio();
    this.setPosition();
    this.$el.show();
    return this;
  };

  PinView.prototype.setContent = function() {
    var block, blockCid, blockIndexOf, color, constant, marginTop;
    blockCid = this.model.get('blockCid');
    block = Bachelor.App.Collections.blocks.get(blockCid);
    blockIndexOf = Bachelor.App.Collections.blocks.indexOf(block);
    if (this.side === 'start') {
      constant = -13;
    }
    if (this.side === 'end') {
      constant = 13;
    }
    marginTop = (blockIndexOf - 1) * constant;
    color = block.get('color');
    return this.$el.css({
      color: color,
      marginTop: marginTop,
      position: 'absolute'
    });
  };

  PinView.prototype.setDraggable = function() {
    return this.$el.draggable({
      axis: 'x',
      containment: 'parent',
      disabled: true,
      stop: this.updateModelOnStopDragging
    });
  };

  PinView.prototype.enableDraggable = function() {
    this.$el.removeClass(this.disabledClasses[this.side]);
    this.$el.addClass(this.enabledClasses[this.side]);
    this.$el.addClass('highlight');
    return this.$el.draggable('option', 'disabled', false);
  };

  PinView.prototype.disableDraggable = function() {
    this.$el.removeClass(this.enabledClasses[this.side]);
    this.$el.addClass(this.disabledClasses[this.side]);
    this.$el.removeClass('highlight');
    this.$el.draggable('option', 'disabled', true);
    return this.$el.removeClass('ui-state-disabled');
  };

  PinView.prototype.setPosition = function() {
    var position, start;
    if (this.ratio) {
      start = this.model.get(this.side);
      position = start / this.ratio;
      return this.$el.css('left', "" + position + "%");
    }
  };

  PinView.prototype.setRatio = function() {
    var _ref;
    return (_ref = this.ratio) != null ? _ref : this.ratio = Bachelor.App.Views.timelineView.ratio;
  };

  PinView.prototype.updateModelOnStopDragging = function(event, ui) {
    var newTimeMark, pinPosition, positionInPercentage, totalWidth;
    totalWidth = this.$el.closest('.timeline').width();
    pinPosition = ui.position.left;
    positionInPercentage = pinPosition / totalWidth * 100;
    newTimeMark = positionInPercentage * this.ratio;
    this.model.set(this.side, newTimeMark);
    return Backbone.Events.trigger('renderAllTimestamps');
  };

  PinView.prototype.updateTime = function() {
    var time;
    time = this.model.get(this.side);
    return Bachelor.App.pop.jumpTo(time);
  };

  return PinView;

})(Backbone.View);
