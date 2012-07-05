MCM.panel.Main = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('mcm.CampaignMonitor')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
         },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,items: [{
                title: _('mcm.scheduledCampaigns')
                ,defaults: { autoHeight: true }
                ,items: [{
                    xtype: 'mcm-grid-scheduledcampaigns'
                    ,cls: 'main-wrapper'
                    ,preventRender: true
                },{
                    xtype: 'mcm-grid-draftcampaigns'
                    ,cls: 'main-wrapper'
                    ,preventRender: true
                }]
            },{
                title: _('mcm.previousCampaigns')
                ,defaults: { autoHeight: true }
                ,items: [{
                    xtype: 'mcm-grid-campaigns'
                    ,cls: 'main-wrapper'
       //             ,preventRender: true
				}]
            },{
                title: _('mcm.recipientLists')
                ,defaults: { autoHeight: true }
                ,items: [{
                    xtype: 'mcm-grid-recipients'
                    ,cls: 'main-wrapper'
       //             ,preventRender: true
                }]
            },{
                title: _('settings')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>Config Settings</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                }/*,{
                    xtype: 'doodles-grid-doodles'
                    ,cls: 'main-wrapper'
                    ,preventRender: true
                }*/]
            }]
        }]
    });
    MCM.panel.Main.superclass.constructor.call(this,config);
};
Ext.extend(MCM.panel.Main,MODx.Panel);
Ext.reg('mcm-panel-main',MCM.panel.Main);
