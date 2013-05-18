// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.TimestampView = (function(_super) {

  __extends(TimestampView, _super);

  function TimestampView() {
    var _this = this;
    this.render = function() {
      return TimestampView.prototype.render.apply(_this, arguments);
    };
    return TimestampView.__super__.constructor.apply(this, arguments);
  }

  TimestampView.prototype.tagName = 'div';

  TimestampView.prototype.className = 'thumbnail';

  TimestampView.prototype.id = '';

  TimestampView.prototype.initialize = function() {
    this.model.on('change', this.render);
    return this.model.view = this;
  };

  TimestampView.prototype.render = function() {
    this.setContent();
    this.appendAttachment();
    return this;
  };

  TimestampView.prototype.setContent = function() {
    this.attributes = {
      "data-start": this.model.get('start'),
      "data-end": this.model.get('end')
    };
    return this.$el.attr(this.attributes);
  };

  TimestampView.prototype.appendAttachment = function() {
    var type;
    this.$el.empty();
    this.attachment = this.model.get('Attachment');
    type = this.attachment.Type.name;
    if (type === 'image') {
      return this.appendImage();
    } else {
      return this.appendText();
    }
  };

  TimestampView.prototype.appendImage = function() {
    var img, thumbUrl, urlInfo;
    urlInfo = pathinfo(app.url + this.attachment.url);
    thumbUrl = urlInfo.dirname + '/thumb/' + urlInfo.basename;
    img = "<img src=\"" + thumbUrl + "\" />";
    return this.$el.append(img);
  };

  TimestampView.prototype.appendText = function() {
    return this.$el.append(this.attachment.name);
  };

  return TimestampView;

})(Backbone.View);