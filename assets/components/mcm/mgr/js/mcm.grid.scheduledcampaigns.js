MCM.grid.ScheduledCampaigns = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-grid-scheduledcampaigns'
        ,url: MCM_CONNECTORS+'connector.php'
        ,baseParams: { action: 'campaigns/getScheduledList' }
        ,fields: ['id','title','subject','preview','created','send_date']
        ,paging: false
		,pageSize: 5
		,showPerPage: false
        ,remoteSort: false
        ,anchor: '97%'
        ,autoExpandColumn: 'subject'
        ,columns: [{
            header: _('mcm.scheduledCampaigns')
            ,dataIndex: 'title'
            ,sortable: true
	    },{
            header: _('mcm.emailSubject')
            ,dataIndex: 'subject'
            ,sortable: true
        },{
            header: _('mcm.sendDate')
			,type: 'datecolumn'
            ,dataIndex: 'send_date'
            ,sortable: false
			,renderer : Ext.util.Format.dateRenderer('d-m-Y, g:i A')
        },{
            header: ''
            ,dataIndex: 'preview'
            ,sortable: false
			,renderer: MCMscheduledCampaignButtons
			,width: 25
			,locked: true
        }]
        ,tbar:[{
            text: _('mcm.newCampaign')
            ,handler: { xtype: 'mcm-window-newcampaign' ,blankValues: true }
        }]
    });
    MCM.grid.ScheduledCampaigns.superclass.constructor.call(this,config)
};
Ext.extend(MCM.grid.ScheduledCampaigns,MODx.grid.Grid);
Ext.reg('mcm-grid-scheduledcampaigns',MCM.grid.ScheduledCampaigns);

