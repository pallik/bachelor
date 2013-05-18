// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.AddButtonsView = (function(_super) {

  __extends(AddButtonsView, _super);

  function AddButtonsView() {
    var _this = this;
    this.slideUpInput = function() {
      return AddButtonsView.prototype.slideUpInput.apply(_this, arguments);
    };
    this.toggleInput = function(e) {
      return AddButtonsView.prototype.toggleInput.apply(_this, arguments);
    };
    this.addBlockOrAttachment = function(e) {
      return AddButtonsView.prototype.addBlockOrAttachment.apply(_this, arguments);
    };
    return AddButtonsView.__super__.constructor.apply(this, arguments);
  }

  AddButtonsView.prototype.el = $('.add-buttons');

  AddButtonsView.prototype.events = {
    'click .add-block': 'toggleInput',
    'click .add-attachment': 'toggleInput',
    'keyup input#name': 'addBlockOrAttachment'
  };

  AddButtonsView.prototype.addBlockOrAttachment = function(e) {
    var ENTER_KEYCODE, ESC_KEYCODE, action, currentKey, input, name, what;
    ENTER_KEYCODE = 13;
    ESC_KEYCODE = 27;
    currentKey = e.which;
    if (currentKey === ESC_KEYCODE) {
      this.slideUpInput();
    }
    if (currentKey === ENTER_KEYCODE) {
      input = this.$('input');
      name = input.val();
      what = input.data('what');
      what = capitalizeFirst(what);
      action = "add" + what;
      Backbone.Events.trigger(action, name);
      return this.slideUpInput();
    }
  };

  AddButtonsView.prototype.toggleInput = function(e) {
    var what;
    e.preventDefault();
    what = $(e.target).data('what');
    return this.$('.input-name').slideToggle().find('input').data('what', what);
  };

  AddButtonsView.prototype.slideUpInput = function() {
    return this.$('.input-name').slideUp(function() {
      return $(this).find('input').val('');
    });
  };

  return AddButtonsView;

})(Backbone.View);