MCM.window.NewCampaign = function(config) {
    config = config || {};
    Ext.applyIf(config,{
    	id: 'mcm-window-newcampaign'
        ,title: _('mcm.create_new_campaign')
        ,url: MCM_CONNECTORS+'connector.php'
        ,saveBtnText: _('mcm.create')
        ,cancelBtnText: _('mcm.cancel')
		,success: function(){
			Ext.getCmp('mcm-grid-draftcampaigns').refresh();
		}
        ,baseParams: {
            action: 'campaigns/create'
        }
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('mcm.campaignTitle')
            ,name: 'title'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('mcm.emailSubject')
            ,name: 'subject'
            ,anchor: '100%'
        },{
            xtype: 'mcm-combo-resource'
            ,fieldLabel: _('mcm.select_resource')
            ,name: 'resourceID'
            ,anchor: '100%'
        },{
            xtype: 'mcm-combo-recipientlists'
            ,fieldLabel: _('mcm.recipient_list')
            ,name: 'recipientList'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('mcm.email_from_name')
            ,name: 'from_name'
            ,anchor: '100%'
            ,value: MCM_DEFAULT_FROM_NAME
        },{
            xtype: 'textfield'
            ,fieldLabel: _('mcm.email_from_address')
            ,name: 'from_address'
            ,anchor: '100%'
            ,value: MCM_DEFAULT_FROM_ADDRESS
        },{
            xtype: 'textfield'
            ,fieldLabel: _('mcm.email_replyto')
            ,name: 'reply_to'
            ,anchor: '100%'
            ,value: MCM_DEFAULT_REPLYTO
       }]
    });
    MCM.window.NewCampaign.superclass.constructor.call(this,config);
};
Ext.extend(MCM.window.NewCampaign,MODx.Window);
Ext.reg('mcm-window-newcampaign',MCM.window.NewCampaign);
