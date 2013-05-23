// Generated by CoffeeScript 1.6.1
var _this = this,
  __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

Bachelor.Views.AddButtonsView = (function(_super) {

  __extends(AddButtonsView, _super);

  function AddButtonsView() {
    var _this = this;
    this.addAttachmentsToBlock = function(attachments) {
      return AddButtonsView.prototype.addAttachmentsToBlock.apply(_this, arguments);
    };
    this.handleAddAttachment = function(e) {
      return AddButtonsView.prototype.handleAddAttachment.apply(_this, arguments);
    };
    this.addBlock = function(e) {
      return AddButtonsView.prototype.addBlock.apply(_this, arguments);
    };
    return AddButtonsView.__super__.constructor.apply(this, arguments);
  }

  AddButtonsView.prototype.el = $('.add-buttons');

  AddButtonsView.prototype.attachmentDialog = null;

  AddButtonsView.prototype.events = {
    'click .add-block': 'addBlock',
    'click .add-attachment': 'handleAddAttachment'
  };

  AddButtonsView.prototype.initialize = function() {
    this.attachmentDialog = this.$el.find('.attachments');
    return this.initAttachmentDialog();
  };

  AddButtonsView.prototype.addBlock = function(e) {
    var newBlock;
    e.preventDefault();
    newBlock = new Bachelor.Models.Block();
    return Bachelor.App.Collections.blocks.add(newBlock);
  };

  AddButtonsView.prototype.handleAddAttachment = function(e) {
    var url;
    e.preventDefault();
    url = Bachelor.App.Collections.attachments.url + "/list";
    return this.ajaxGet(url);
  };

  AddButtonsView.prototype.ajaxGet = function(url) {
    var _this = this;
    return $.ajax({
      type: "GET",
      url: url,
      dataType: "json",
      success: function(data) {
        return _this.loadTemplate(data);
      },
      error: function(data) {
        return debug(data);
      }
    });
  };

  AddButtonsView.prototype.initAttachmentDialog = function() {
    var _this = this;
    return this.attachmentDialog.dialog({
      modal: true,
      autoOpen: false,
      width: 'auto',
      buttons: {
        'Add attachments to block': function() {
          _this.attachmentDialog.dialog('close');
          return _this.getDataForRequest();
        },
        'Cancel': function() {
          return $(this).dialog('close');
        }
      }
    });
  };

  AddButtonsView.prototype.loadTemplate = function(data) {
    var notMasterActiveBlocksCount, template;
    notMasterActiveBlocksCount = Bachelor.App.Collections.blocks.where({
      status: true,
      master: false
    }).length;
    template = _.template(this.$el.find('#listAttachments').html(), data);
    if (notMasterActiveBlocksCount === 0) {
      template = 'You have to add blocks first!';
    }
    this.attachmentDialog.html(template);
    return this.attachmentDialog.dialog('open');
  };

  AddButtonsView.prototype.getDataForRequest = function() {
    var $attachments, attachmentsRequestData;
    $attachments = this.attachmentDialog.find('.select-attachment:checked');
    attachmentsRequestData = {
      presentation: new Array(),
      text: new Array(),
      image: new Array()
    };
    $attachments.each(function() {
      var id, type;
      type = $(this).data('type');
      id = $(this).data('id');
      return attachmentsRequestData[type].push(id);
    });
    attachmentsRequestData = JSON.stringify(attachmentsRequestData);
    return this.sendRequestForData(attachmentsRequestData);
  };

  AddButtonsView.prototype.sendRequestForData = function(data) {
    var url;
    url = Bachelor.App.Collections.attachments.url + "/getDataFromRequest";
    return ajaxPost(url, data, this.addAttachmentsToBlock, debug);
  };

  AddButtonsView.prototype.addAttachmentsToBlock = function(attachments) {
    var $block, blockCid;
    $block = this.attachmentDialog.find('.select-block:checked');
    blockCid = $block.val();
    _.each(attachments, function(attachment) {
      var attachmentAttribute, timestampModel;
      attachmentAttribute = attachment.Attachment;
      attachmentAttribute['Type'] = attachment.Type;
      timestampModel = new Bachelor.Models.Timestamp();
      timestampModel.set('blockCid', blockCid);
      timestampModel.set('Attachment', attachmentAttribute);
      timestampModel.set('attachment_id', attachmentAttribute.id);
      return Bachelor.App.Collections.timestamps.add(timestampModel);
    });
    return Backbone.Events.trigger('renderAllTimestamps');
  };

  return AddButtonsView;

})(Backbone.View);
