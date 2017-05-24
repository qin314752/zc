/**
 * Created by Administrator on 2015/10/24.
 */
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        credits:{
            enabled:0
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['1月份', '2月份', '3月份', '4月份', '5月份', '6月份']
        },
        yAxis: {
            title: {
                text: '投资金额'
            },
            labels: {
                formatter:function(){
                    if(this.value <=10) {
                        return "投资金额：("+this.value+")元";
                    }else if(this.value >10 && this.value <=20) {
                        return "投资金额：("+this.value+")元";
                    }else if(this.value >10 && this.value <=20) {
                        return "投资金额：(" + this.value + ")元";
                    }else if(this.value >20 && this.value <=30) {
                        return "投资金额：(" + this.value + ")元";
                    }else if(this.value >30 && this.value <=40) {
                        return "投资金额：(" + this.value + ")元";
                    }else {
                        return "投资金额：("+this.value+")元";
                    }
                }


            }
        },
        tooltip: {
            enabled: false,
            formatter: function() {
                return "<b>"+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'°C';
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: '投资走势',
            color:'#fc8026',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5]
        }, ]
    });
});