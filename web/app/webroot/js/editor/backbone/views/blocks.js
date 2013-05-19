// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.BlocksView = (function(_super) {

  __extends(BlocksView, _super);

  function BlocksView() {
    var _this = this;
    this.addBlockView = function(block) {
      return BlocksView.prototype.addBlockView.apply(_this, arguments);
    };
    return BlocksView.__super__.constructor.apply(this, arguments);
  }

  BlocksView.prototype.el = $('.blocks');

  BlocksView.prototype.initialize = function() {
    Bachelor.App.Collections.blocks.on('add', this.addBlockView);
    return this.setResizable();
  };

  BlocksView.prototype.addBlockView = function(block) {
    var view;
    view = new Bachelor.Views.BlockView({
      model: block
    });
    this.$el.append(view.render().el);
    return adjustBlocksContainerHeight();
  };

  BlocksView.prototype.setResizable = function() {
    return this.$el.resizable({
      containment: 'parent'
    });
  };

  return BlocksView;

})(Backbone.View);
