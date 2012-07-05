MCM.window.ScheduleCampaign = function(config) {
    config = config || {};
    Ext.applyIf(config,{
    	id: 'mcm-window-schedulecampaign'
        ,title: _('mcm.schedule_campaign')
        ,onOpen: function(){
         alert('open');
        }
        ,url: MCM_CONNECTORS+'connector.php'
        ,saveBtnText: _('.mcm.schedule_campaign')
        ,cancelBtnText: _('mcm.cancel')
		,success: function(){
			Ext.getCmp('mcm-grid-draftcampaigns').refresh();
			Ext.getCmp('mcm-grid-scheduledcampaigns').refresh();
		}
        ,baseParams: {
            action: 'campaigns/Schedule'
            
        }
		,listeners:{
			show:function(field, newVal, oldVal){
			}
    	}
        ,fields: [{
            xtype: 'displayfield'
            ,name: 'title'
            ,fieldLabel: _('mcm.campaign')
			,labelAlign: 'left'
            ,anchor: '100%'
	   },{
            xtype: 'xdatetime'
            ,fieldLabel: _('mcm.schedule_at')
            ,name: 'date'
            ,id: 'mcm-campaign-schedule'
            ,allowBlank: false
            ,dateFormat: MODx.config.manager_date_format
            ,timeFormat: MODx.config.manager_time_format
            ,dateWidth: 120
            ,timeWidth: 120
	   },{
            xtype: 'mcm-combo-recipientlists'
            ,fieldLabel: _('mcm.recipients')
            ,name: 'ListID'
            ,id: 'mcm-campaign-schedule-recipientlists'
            ,allowBlank: false
        },{	   		
			xtype: 'hidden'
	   		,fieldLabel: 'ID#'
	   		,name: 'campaignid'
	   		,anchor: '100%'
	   		,value: ''
	   }]
    });
    MCM.window.ScheduleCampaign.superclass.constructor.call(this,config);
};
Ext.extend(MCM.window.ScheduleCampaign,MODx.Window);
Ext.reg('mcm-window-schedulecampaign',MCM.window.ScheduleCampaign);
