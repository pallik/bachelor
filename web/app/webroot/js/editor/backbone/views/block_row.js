// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.BlockRowView = (function(_super) {

  __extends(BlockRowView, _super);

  function BlockRowView() {
    var _this = this;
    this.render = function() {
      return BlockRowView.prototype.render.apply(_this, arguments);
    };
    return BlockRowView.__super__.constructor.apply(this, arguments);
  }

  BlockRowView.prototype.tagName = 'div';

  BlockRowView.prototype.className = 'block-row';

  BlockRowView.prototype.id = '';

  BlockRowView.prototype.initialize = function() {
    return this.model.rowView = this;
  };

  BlockRowView.prototype.render = function() {
    this.setContent();
    return this;
  };

  BlockRowView.prototype.setContent = function() {
    var blockCid, target;
    target = this.model.get('target');
    blockCid = this.model.cid;
    this.$el.attr('data-block-cid', blockCid);
    this.$el.addClass(target);
    return this.$el.css('border-color', this.model.get('color'));
  };

  return BlockRowView;

})(Backbone.View);
