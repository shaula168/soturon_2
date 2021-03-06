@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('show_submit_task', $classroom, $task) }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2 mb-3 d-flex">
                    <div class="h2 mt-auto mb-auto">{{ $task->title }}</div>
                </div>
                <div class="mb-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id) }}">トップ</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id . '/issues') }}">質問</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id . '/submissions') }}">提出一覧</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id . '/answer') }}">模範解答</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id . '/standings') }}">順位表</a></li>
                        @if ($is_teacher)
                            <li class="nav-item"><a class="nav-link" href="{{ url('classrooms/' . $classroom->id . '/tasks/' . $task->id . '/status-lists') }}">提出状況一覧</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="mb-3">提出 No.{{ $submit->id }}</h3>
                    @if($submit->result == 1)
                        <h4>結果：<b class="badge-pill badge-success">正解</b></h4>
                    @elseif($submit->result == -1)
                        <h4>結果：<b class="badge-pill badge-warning">不正解</b></h4>
                    @else
                        <h4>結果：<b class="badge-pill badge-secondary">判定中</b></h4>
                    @endif
                    <div id="editor" style="height: 500px" class="mb-5"></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
                    <script>
                        var editor = ace.edit("editor");
                        editor.setTheme("ace/theme/monokai");
                        editor.setFontSize(14);
                        editor.getSession().setMode("ace/mode/java");
                        editor.getSession().setUseWrapMode(true);
                        editor.getSession().setTabSize(2);
                        editor.setValue('{{ $submit->code_txt }}');
                        editor.setReadOnly(true);
                    </script>
                    <noscript>JavaScriptを有効にしてください。</noscript>

                    @if (!empty($submit->cmpinfo))
                        <div class="form-group mb-3">
                            <label for="cmpinfo" class="h5">コンパイルエラー出力：</label>
                            <textarea id="cmpinfo" class="form-control" readonly="readonly" rows="5">{{ $submit->cmpinfo }}</textarea>
                        </div>
                    @endif
                    @if (!empty($submit->stderr))
                        <div class="form-group mb-3">
                            <label for="stderr" class="h5">標準エラー出力：</label>
                            <textarea id="stderr" class="form-control" readonly="readonly" rows="5">{{ $submit->stderr }}</textarea>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection