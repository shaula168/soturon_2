@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('create_task', $classroom) }}
@endsection

@section('message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="mt-2 mb-3 d-flex">
                    <div class="h2 mt-auto mb-auto">{{ $classroom->title }}</div>
                </div>
                <div class="card">
                    <div class="card-header">新規問題作成</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <strong class="col-md-3 text-md-right"><span class="text-danger">※</span>は必須項目</strong>
                        </div>
                        
                        <form method="post" action="{{ route('tasks.store') }}" onSubmit="return check()">
                            {{ csrf_field() }}

                            <input type="hidden" name="class_id" value="{{ $classroom->id }}">

                            <div class="form-group row mb-5">
                                <label for="title" class="col-md-3 col-form-label text-md-right mt-auto mb-auto"><span class="text-danger">※</span>問題タイトル</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <input type="text" name="title" id="title" class="w-100">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="statement" class="col-md-3 col-form-label text-md-right mt-auto mb-auto"><span class="text-danger">※</span>問題文</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <textarea name="statement" id="statement" rows="5" class="w-100"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="hint" class="col-md-3 col-form-label text-md-right mt-auto mb-auto">ヒント</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <textarea name="hint" id="hint" rows="5" class="w-100"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <p class="col-md-3 text-md-right mt-auto mb-auto">
                                    テンプレート<br><br>
                                    (ここに入力した内容はテンプレートとして生徒のエディタに表示されます。)
                                </p>
                                <div class="col-md-8">
                                    <div id="editor" style="height: 400px"></div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
                                    <script>
                                        var editor = ace.edit("editor");
                                        editor.setTheme("ace/theme/monokai");
                                        editor.setFontSize(14);
                                        editor.getSession().setMode("ace/mode/java");
                                        editor.getSession().setUseWrapMode(true);
                                        editor.getSession().setTabSize(2);
                                    </script>
                                    <script>
                                        function check() {
                                            document.getElementById("code_tmp").value = editor.getValue();
                                            return true;
                                        }
                                    </script>
                                    <input name="code_tmp" id="code_tmp" type="hidden">
                                    <noscript>JavaScriptを有効にしてください。</noscript>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="input" class="col-md-3 col-form-label text-md-right mt-auto mb-auto">入力値</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <textarea name="input" id="input" rows="3" class="w-100"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-5">
                                <label for="output" class="col-md-3 col-form-label text-md-right mt-auto mb-auto"><span class="text-danger">※</span>出力値（答え）</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <textarea name="output" id="output" rows="3" class="w-100"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <label for="deadline" class="col-md-3 col-form-label text-md-right mt-auto mb-auto">提出期限</label>
                                <div class="col-md-8  d-flex align-items-center">
                                    <input type="date" name="deadline" id="deadline" class="w-100">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12  d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">作成する</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection