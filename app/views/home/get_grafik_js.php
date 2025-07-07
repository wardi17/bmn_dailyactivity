<script>
    $(document).ready(function(){
        const dateya = new Date();
        let bulan = dateya.getMonth()+1;
        let tahun = dateya.getFullYear();
        get_datagrafik(tahun,bulan);
    })

        //untuk menamilkan grafik
        function get_datagrafik(tahun,bulan){
            $.ajax({
                    url:"<?=base_url?>/home/get_grafik",
                    method:'POST',
                    data:{tahun:tahun,bulan:bulan},
                    dataType:'json',      
                    success:function(result){
                     //   console.log(result)
                    get_grafik(result,tahun)
                    }
                });

        }

    function get_grafik(result,tahun){
            let text_t = 'Grafik Daily Activity '+' '+ tahun;
            Highcharts.chart('grafik', {
            title: {
                text: text_t,
                align: 'center'
            },
            subtitle: {
                text: '',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: ''
                }
            },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },


                plotOptions: {
                        series: {
                            cursor: 'pointer',
                            point: {
                                events: {
                                    click: function() {
                                        alert ('Category: '+ this.category +', value: '+ this.y);
                                    }
                                }
                            }
                        }
            },
        
        //untuk get data
                series:
                    $.each(result,function(key,value){
                    value
                    }),
        //end get data                   
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

    }

 // end grafik
</script>