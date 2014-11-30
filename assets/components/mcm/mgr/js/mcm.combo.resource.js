MCM.combo.Resource = function(config){
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-combo-resource' 
	,name: 'resourceID'
	,hiddenName: 'resourceID'
        ,displayField: 'pagetitle'
        ,valueField: 'id'
	,mode: 'remote'
	,fields: ['id','pagetitle']
	,forceSelection: true
	,editable: false
        ,enableKeyEvents: true
	,pageSize: 20
        ,url: MODx.config.connector_url ? MODx.config.connector_url : MODx.config.connectors_url+'resource/index.php'
        ,baseParams: { 
		action: MODx.config.connector_url ? 'resource/getList' : 'getList'
		,showNone: true
	}         
    });
    MCM.combo.Resource.superclass.constructor.call(this, config);
};
Ext.extend(MCM.combo.Resource,MODx.combo.ComboBox);
Ext.reg('mcm-combo-resource',MCM.combo.Resource);

