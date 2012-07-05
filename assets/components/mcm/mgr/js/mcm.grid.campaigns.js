MCM.grid.Campaigns = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-grid-campaigns'
        ,url: MCM_CONNECTORS+'connector.php'
        ,baseParams: { action: 'campaigns/getList' }
        ,fields: ['id','title','subject','preview','last_sent','recipients','opens','unsubscribes','bounces','uniqueOpens']
        ,paging: true
		,pageSize: 10
        ,remoteSort: false
        ,anchor: '97%'
        ,autoExpandColumn: 'subject'
        ,columns: [{
            header: _('mcm.campaignTitle')
            ,dataIndex: 'title'
            ,sortable: true
	    },{
            header: _('mcm.emailSubject')
            ,dataIndex: 'subject'
            ,sortable: true
        },{
			type: 'datecolumn'
            ,header: _('mcm.lastSent')
            ,dataIndex: 'last_sent'
            ,sortable: true
			,renderer : Ext.util.Format.dateRenderer('d-m-Y, g:i A')
        },{
            header: _('mcm.recipients')
            ,dataIndex: 'recipients'
            ,sortable: false
			,width:30
			,locked:true
        },{
            header: _('mcm.stats_opens')
            ,dataIndex: 'uniqueOpens'
            ,sortable: false
			,renderer: MCMpercentOfRecipients
			,width:30
			,locked:true
        },{
            header: _('mcm.stats_unsubscribes')
            ,dataIndex: 'unsubscribes'
            ,sortable: false
			,width:30
			,locked:true
        },{
            header: _('mcm.stats_bounces')
            ,dataIndex: 'bounces'
            ,sortable: false
			,width:30
			,locked:true
        },{
            header: ''
            ,dataIndex: 'preview'
            ,sortable: false
			,renderer: MCMsentCampaignButtons
			,width: 30
			,locked: true
        }]
    });
    MCM.grid.Campaigns.superclass.constructor.call(this,config)
};
Ext.extend(MCM.grid.Campaigns,MODx.grid.Grid);
Ext.reg('mcm-grid-campaigns',MCM.grid.Campaigns);


function MCMpercentOfRecipients(val,b,record){
		var recipients = parseInt(record.json.recipients);
			val = parseInt(val);
		var percent = Math.round((val / recipients)*1000) / 10;
		
		return val+' <span class="percent">('+percent+'%)</span>';
	};

