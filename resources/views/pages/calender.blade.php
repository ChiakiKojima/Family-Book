<h3 class="text-secondary">{{ $year }}年{{ $month }}月</h3>
<table class="table">
    <thead>
        <tr class="table-secondary">
          <th scope="col">日</th>
          <th scope="col">月</th>
          <th scope="col">火</th>
          <th scope="col">水</th>
          <th scope="col">木</th>
          <th scope="col">金</th>
          <th scope="col">土</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!--1日までは空白を表示する-->
            @for($i=0; $i < $first_day; $i++)
                <td>&nbsp;</td>
            @endfor
            @for($day=1; $day <= $countdate; $day++)
                <td>
                    @if(!$results->isEmpty())
                        @if(in_array($day, $updated_date))
                            <a href="{{ route('date', ['year' => $year, 'month' => $month, 'day' => $day]) }}">{{ $day }}</a>
                        @else
                            {{ $day }}
                        @endif
                    @else
                        {{ $day }}
                    @endif    
                </td>
                <!--その年月日が土曜日だったら改行させる-->
                @if(date( "w", mktime( 0, 0, 0, $month, $day, $year )) == 6)
                    </tr>
                    <tr>
                @endif
            @endfor
        </tr>
    </tbody>
</table>
<div class="text-center">
    <a href="{{ route('prev', ['year' => $year, 'month' => $month]) }}" class="btn btn-outline-secondary"}>← 前月</a>
    <a href="{{ route('next', ['year' => $year, 'month' => $month]) }}" class="btn btn-outline-secondary">翌月 →</a>
</div>