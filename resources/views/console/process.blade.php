@extends('blade.header')

@section('content')
    <span class="btn-group">
        <a href="viewNewProcess"><button type="primary" @if($navi_status != 1) outline @endif>待處理 ({{$comment_count[0]}})</button></a>
        @if(0)<a href="viewAdminProcess"><button type="primary" @if($navi_status != 2) outline @endif>相關單位已回覆建言 ({{$comment_count[2]}})</button></a>@endif
        <a href="viewFinishedProcess"><button type="primary" @if($navi_status != 4) outline @endif>已回覆 ({{$comment_count[3]}})</button></a>
        <a href="viewDenyProcess"><button type="primary" @if($navi_status != 5) outline @endif>已拒絕 ({{$comment_count[4]}})</button></a>
        <a href="viewAllProcess"><button type="primary" @if($navi_status != 3) outline @endif>全部建言</button></a>
        <a href="/consoleLogin"><button type="red" >登出</button></a>
    </span>


    <row cols="1">

        <column cols="12">
            <div>
                <table>
                    <thead>
                    <tr>
                        <th class="width-1">處理編號</th>
                        <th class="width-4">反應主題</th>
                        <th class="width-2">反應人</th>
                        <th class="width-2">反應日期</th>
                        <th class="width-3">處理狀態</th>
                    </tr>
                    <tbody>
                    @foreach($comment_detail as $comments_detail)
                        <tr>
                            <td>{{$comments_detail -> id}}</td>
                            <td><a href="viewCertainProcess/{{$comments_detail -> id}}">{{$comments_detail -> topic}}</a></td>
                            <td>{{$comments_detail -> sid}}</td>
                            <td>{{$comments_detail -> resp_time}}</td>
                            <td>
                                @if($comments_detail -> cancel == 1)
                                    <div class="alert alert-error"><i class="fa fa-times"></i> 使用者已撤銷</div>
                                @elseif($comments_detail -> reply_OK == 0)
                                    <div class="alert alert-primary"><i class="fa fa-paper-plane"></i> 建言已建立，未審核</div>
                                @elseif($comments_detail -> reply_OK == 1)
                                    <div class="alert alert-warning"><i class="fa fa-share-square"></i> 已派送至相關單位處理</div>
                                @elseif($comments_detail -> reply_OK == 3)
                                    <div class="alert alert-success"><i class="fa fa-check"></i> 已回覆</div>
                                @elseif($comments_detail -> reply_OK == 4)
                                    <div class="alert alert-error"><i class="fa fa-exclamation-triangle"></i> 因相關原因，不予回覆</div>
                                @elseif($comments_detail -> reply_OK == 5)
                                    <div class="alert alert-error"><i class="fa fa-exclamation-triangle"></i> 因上傳禁止的檔案，不予回覆</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{$comment_detail->render()}}
                </div>
            </div>
        </column>

    </row>
@stop

@extends('blade.footer')