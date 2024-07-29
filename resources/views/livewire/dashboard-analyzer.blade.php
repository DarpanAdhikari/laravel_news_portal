<div>
    <ul class="insights">  
       <a href="{{url('post/englishpost/draft')}}">
        <li>
            <i class='bx bx-calendar-check'></i>
            <span class="info">
                <h3>
                    {{ Str::shortNumber($enDraft) }}
                </h3>
                <p>English Draft</p>
            </span>
        </li>
       </a>
       <a href="{{url('post/nepalipost/draft')}}">
           <li>
               <i class='bx bx-calendar-check'></i>
               <span class="info">
                   <h3>
                    {{ Str::shortNumber($npDraft) }}
                   </h3>
                   <p>Nepali Draft</p>
               </span>
           </li>
       </a>
      
        <li><i class='bx bx-show-alt'></i>
            <span class="info">
                <h3>
                    {{ Str::shortNumber($totalVisit) }}
                </h3>
                <p>Site Visit</p>
            </span>
        </li>
        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
            <path d="M 25.167969 5.0058594 C 24.781877 4.9968865 24.394532 5.014912 24.007812 5.0625 C 22.976561 5.1894012 21.954004 5.5214624 21 6.0722656 C 19.738126 6.8008205 18.867614 7.8795934 18.189453 9.0625 L 18.074219 8.9960938 L 4.0742188 32.996094 L 4.1894531 33.0625 C 3.5013617 34.243015 3 35.539748 3 37 C 3 41.406432 6.5935644 45 11 45 C 13.946182 45 16.422265 43.319288 17.810547 40.9375 L 17.925781 41.003906 L 25 28.876953 L 32.074219 41.003906 C 34.278505 44.817 39.185255 46.130214 43 43.927734 C 46.816027 41.724515 48.130947 36.816015 45.927734 33 L 45.927734 32.998047 L 31.927734 9 C 30.481872 6.4957324 27.870611 5.0686695 25.167969 5.0058594 z M 25.130859 6.9960938 C 27.155284 7.0392142 29.104113 8.1100176 30.195312 10 L 30.197266 10.001953 L 30.197266 10.003906 L 44.197266 34.003906 C 45.856861 36.883192 44.878669 40.533286 42 42.195312 C 39.120015 43.8581 35.467467 42.879973 33.804688 40 L 33.802734 39.998047 L 19.804688 16 L 19.804688 15.998047 L 19.802734 15.996094 C 18.143139 13.116808 19.121331 9.4667144 22 7.8046875 C 22.719996 7.3889907 23.488252 7.1380832 24.261719 7.0410156 C 24.551769 7.0046153 24.841656 6.9899337 25.130859 6.9960938 z M 17.212891 14.441406 C 17.372969 15.315284 17.603702 16.188437 18.072266 17 L 18.072266 17.001953 L 23.841797 26.892578 L 18.728516 35.658203 C 18.065728 31.912371 14.931107 29 11 29 C 10.084587 29 9.236334 29.238188 8.4160156 29.523438 L 17.212891 14.441406 z M 11 31 C 14.325556 31 17 33.674446 17 37 C 17 40.325554 14.325556 43 11 43 C 7.6744439 43 5 40.325554 5 37 C 5 33.674446 7.6744439 31 11 31 z"></path>
            </svg>
            <span class="info">
                <h3>
                    {{ Str::shortNumber(14721) }}
                    
                </h3>
                <p>Running Ads</p>
            </span>
        </li>
    </ul>
    <!-- End of Insights -->

    <div class="bottom-data ">
               <!-- Pie chart -->
               <div class="pieChart">
                <div id="enPostPieChart"></div>
            </div>
{{-- bar chart --}}
        <div class="barChart">
            <div id="enBarChart"></div>
        </div>
        {{-- pie chart --}}
        <div class="pieChart">
            <div id="npPostPieChart"></div>
        </div>
{{-- bar chart --}}
    <div class="barChart">
        <div id="npBarChart"></div>
    </div>
    </div>
    @push('script')
    <script>
      var category = [
    "{{ __('navigation')['name'][1] }}",
    "{{ __('navigation')['name'][2] }}",
    "{{ __('navigation')['name'][3] }}",
    "{{ __('navigation')['name'][4] }}",
    "{{ __('navigation')['name'][5] }}",
    "{{ __('navigation')['name'][6] }}",
    "{{ __('navigation')['name'][7] }}"
];
// for english post
var enPostNo = [
    "{{$enPostCount[1]}}",
    "{{$enPostCount[2]}}",
    "{{$enPostCount[3]}}",
    "{{$enPostCount[4]}}",
    "{{$enPostCount[5]}}",
    "{{$enPostCount[6]}}",
    "{{$enPostCount[7]}}",
]
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawEnPieChart);

function drawEnPieChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Category');
    data.addColumn('number', 'Post');
    
    for (var i = 0; i < category.length; i++) {
        data.addRow([category[i], parseInt(enPostNo[i])]);
    }

    const pieOptions = {
        title: 'English Post Ratio',
        width: 420,
        height: 300,
        is3D:true
    };

    const chart = new google.visualization.PieChart(document.getElementById('enPostPieChart'));
    chart.draw(data, pieOptions);
}
// for nepali post
var npPostNo = [
    "{{$npPostCount[1]}}",
    "{{$npPostCount[2]}}",
    "{{$npPostCount[3]}}",
    "{{$npPostCount[4]}}",
    "{{$npPostCount[5]}}",
    "{{$npPostCount[6]}}",
    "{{$npPostCount[7]}}",
]
google.charts.setOnLoadCallback(drawNpPieChart);
function drawNpPieChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Category');
    data.addColumn('number', 'Post');
    
    for (var i = 0; i < category.length; i++) {
        data.addRow([category[i], parseInt(npPostNo[i])]);
    }

    const pieOptions = {
        title: 'Nepali Post Ratio',
        width: 420,
        height: 300,
        is3D:true
    };

    const chart = new google.visualization.PieChart(document.getElementById('npPostPieChart'));
    chart.draw(data, pieOptions);
}

// bar chart for english post
var enViews = [
    "{{$enViews[1]}}",
    "{{$enViews[2]}}",
    "{{$enViews[3]}}",
    "{{$enViews[4]}}",
    "{{$enViews[5]}}",
    "{{$enViews[6]}}",
    "{{$enViews[7]}}",
];
var enComments = [
    "{{$enCmtCount[1]}}",
    "{{$enCmtCount[2]}}",
    "{{$enCmtCount[3]}}",
    "{{$enCmtCount[4]}}",
    "{{$enCmtCount[5]}}",
    "{{$enCmtCount[6]}}",
    "{{$enCmtCount[7]}}",
];
var enLikes = [
    "{{$enLikeCount[1]}}",
    "{{$enLikeCount[2]}}",
    "{{$enLikeCount[3]}}",
    "{{$enLikeCount[4]}}",
    "{{$enLikeCount[5]}}",
    "{{$enLikeCount[6]}}",
    "{{$enLikeCount[7]}}",
];
google.charts.setOnLoadCallback(drawEnBarChart);

function drawEnBarChart() {
    var data = new google.visualization.DataTable();
data.addColumn('string', 'Category');
data.addColumn('number', 'Views');
data.addColumn('number', 'comnt');
data.addColumn('number', 'Likes');
for (var i = 0; i < category.length; i++) {
    data.addRow([category[i], parseInt(enViews[i]), parseInt(enComments[i]), parseInt(enLikes[i])]);
}

const barOptions = {
  title:'English Audience Response',
  width: 600,
  height: 300,
};

const chart = new google.visualization.BarChart(document.getElementById('enBarChart'));
  chart.draw(data, barOptions);
}

// nepali post barchart info
var npViews = [
    "{{$npViews[1]}}",
    "{{$npViews[2]}}",
    "{{$npViews[3]}}",
    "{{$npViews[4]}}",
    "{{$npViews[5]}}",
    "{{$npViews[6]}}",
    "{{$npViews[7]}}",
];
var npComments = [
    "{{$npCmtCount[1]}}",
    "{{$npCmtCount[2]}}",
    "{{$npCmtCount[3]}}",
    "{{$npCmtCount[4]}}",
    "{{$npCmtCount[5]}}",
    "{{$npCmtCount[6]}}",
    "{{$npCmtCount[7]}}",
];
var npLikes = [
    "{{$npLikeCount[1]}}",
    "{{$npLikeCount[2]}}",
    "{{$npLikeCount[3]}}",
    "{{$npLikeCount[4]}}",
    "{{$npLikeCount[5]}}",
    "{{$npLikeCount[6]}}",
    "{{$npLikeCount[7]}}",
];
google.charts.setOnLoadCallback(drawNpBarChart);

function drawNpBarChart() {
    var data = new google.visualization.DataTable();
data.addColumn('string', 'Category');
data.addColumn('number', 'Views');
data.addColumn('number', 'comnt');
data.addColumn('number', 'Likes');
for (var i = 0; i < category.length; i++) {
    data.addRow([category[i], parseInt(npViews[i]), parseInt(npComments[i]), parseInt(npLikes[i])]);
}

const barOptions = {
  title:'Nepali Audience Response',
  width: 600,
  height: 300,
};

const chart = new google.visualization.BarChart(document.getElementById('npBarChart'));
  chart.draw(data, barOptions);
}
setInterval(() => {
    location.reload();
}, 2000*60);
        </script>
    @endpush
</div>
