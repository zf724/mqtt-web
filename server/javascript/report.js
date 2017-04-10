window.onload=function()
{
    getdatafromDB();
}

var getdatafromDB = function(){
    $.ajax({
        url: "reportapi.php",
        type: "POST",
        dataType:"json",
        error: function(){
            alert('Error loading XML document');
        },
        success:function(data){
            bar(data);
        }
    });
}
function bar(Data)
{
    if(Data.length==null || Data.length == 0)
        return;

    var labels=[], flow=[];
    for(var i=0;i<Data.length;i++){
        labels.push(Data[i].name);
        flow.push(Data[i].weight);
    }

    var data = [
        {
            name : 'Weight',
            value:flow,
            color:'#219f18',
            line_width:2
        }
    ];

    var chart = new iChart.LineBasic2D({
        render : 'canvasDiv',
        data: data,
        align:'center',
        title : {
            text:'设备用户信息折线图',
            font : '微软雅黑',
            fontsize:24,
            color:'#333333'
        },
        subtitle : {
            text:'（体重变化趋势）',
            font : '微软雅黑',
            color:'#333333'
        },
        footnote : {
            text:'oqsmart.com.cn',
            font : '微软雅黑',
            fontsize:11,
            fontweight:600,
            padding:'0 28',
            color:'#333333'
        },
        width : 800,
        height : 400,
        shadow:true,
        shadow_color : '#ffffff',
        shadow_blur : 8,
        shadow_offsetx : 0,
        shadow_offsety : 0,
        background_color:'#f5f5f5',
        animation : true,//开启过渡动画
        animation_duration:600,//600ms完成动画
        tip:{
            enable:true,
            shadow:true,
            listeners:{
                //tip:提示框对象、name:数据名称、value:数据值、text:当前文本、i:数据点的索引
                parseText:function(tip,name,value,text,i){
                    return "<span style='color:#0039c1;font-size:12px;'>"+labels[i]+"体重约:<br/>"+
                        "</span><span style='color:#0039c1;font-size:20px;'>"+value+"公斤</span>";
                }
            }
        },
        crosshair:{
            enable:true,
            line_color:'#ec4646'
        },
        sub_option : {
            smooth : true,
            label:false,
            hollow:false,
            hollow_inside:false,
            point_size:8
        },
        coordinate:{
            width:640,
            height:260,
            striped_factor : 0.18,
            grid_color:'#dddddd',
            axis:{
                color:'#dddddd',
                width:[0,0,4,4]
            },
            scale:[{
                position:'left',
                start_scale:0,
                end_scale:100,
                scale_space:10,
                scale_size:2,
                scale_enable : false,
                label : {color:'#333333',font : '微软雅黑',fontsize:11,fontweight:600},
                scale_color:'#333333'
            },{
                position:'bottom',
                label : {color:'#333333',font : '微软雅黑',fontsize:11,fontweight:600},
                scale_enable : false,
                labels:labels
            }]
        }
    });
    //利用自定义组件构造左侧说明文本
    chart.plugin(new iChart.Custom({
        drawFn:function(){
            //计算位置
            var coo = chart.getCoordinate(),
                x = coo.get('originx'),
                y = coo.get('originy'),
                w = coo.width,
                h = coo.height;
            //在左上侧的位置，渲染一个单位的文字
            chart.target.textAlign('start')
                .textBaseline('bottom')
                .textFont('600 11px 微软雅黑')
                .fillText('体重(公斤)',x-40,y-12,false,'#333333')
                .textBaseline('top')
                .fillText('(用户)',x+w+12,y+h+10,false,'#333333');

        }
    }));
    //开始画图
    chart.draw();
}