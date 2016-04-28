@extends('wpanel.master')

@section('content')
    <? echo phpinfo(); ?>
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3>
                        <i class="font-icon font-icon-plus-1"></i> Add New Video
                    </h3>
                </div>
            </div>
        </div>
    </header>

    <section class="card">
        <div class="card-block">
            <h5 class="with-border">New Video Data</h5>
            <form enctype="multipart/form-data" action="{{ route('video.store') }}"
                  method="post" class="form-horizontal" id="realDropzone">
                {{ csrf_field() }}
                <div class=" row">
                    <div class="col-xs-12 m-b-md">
                        <fieldset class="form-group">
                            <label class="form-label" for="video_title">Video title</label>
                            <input type="text" class="form-control {{ $errors->has('video_title') ? 'form-control-danger' : '' }}"
                                   id="video_title" name="video_title" placeholder="Video Title" />
                            @if ($errors->has('video_title'))
                                <small class="text-muted" style="color: #fa424a;">
                                    {{ $errors->first('video_title') }}
                                </small>
                            @endif
                        </fieldset>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <fieldset class="form-group">
                            <label class="form-label">Video Image Cover (1280x720 px or 16:9 ratio)</label>
                            <input type="file" multiple="true" class="form-control" name="image" id="image" />
                        </fieldset>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <fieldset class="form-group">
                            <label class="form-label">Video Details, Links, and Info</label>
                            @include('tinymce::tpl')
                            <textarea class="tinymce"></textarea>
                        </fieldset>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <fieldset class="form-group">
                            <label class="form-label">Short description of the video</label>
                            <textarea rows="4" class="form-control" name="video_desc" id="video_desc"
                                      placeholder="Textarea"></textarea>
                        </fieldset>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <div style="width: 25%">
                            <fieldset class="form-group">
                                <label class="form-label">Video Category</label>
                                <select class="bootstrap-select bootstrap-select-arrow">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->cat_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <fieldset class="form-group">
                            <label class="form-label">Video tags</label>
                            <input type="text" class="form-control maxlength-simple" id="tags" placeholder="Tags" />
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label class="form-label" for="time-mask-input">Video duration</label>
                            <input type="email" class="form-control" id="video-duration">
                            <small class="text-muted">Video duration: HH:MM:SS</small>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Who is allowed to view this video?</label>
                            <select class="bootstrap-select bootstrap-select-arrow" id="access" name="access">
                                <option value="guest">Guest (everyone)</option>
                                <option value="registered">Registered Users (free registration must be enabled)</option>
                                <option value="subscriber">Subscriber (only paid subscription users)</option>
                            </select>
                            <small class="text-muted">User Access</small>
                        </fieldset>
                    </div>
                    <div class="col-lg-4 p-t">
                        <fieldset class="form-group">
                            <div class="checkbox-toggle">
                                <input type="checkbox" id="check-toggle-1" />
                                <label for="check-toggle-1">Is this video Featured</label>
                            </div>
                            <div class="checkbox-toggle">
                                <input type="checkbox" id="check-toggle-2" checked />
                                <label for="check-toggle-2">Is this video Active</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <section class="card">
                            <header class="card-header card-header-xl">
                                Video Source
                            </header>
                            <div class="card-block">
                                <p class="card-text">
                                <div class="form-group row">
                                    <label for="exampleSelect" class="col-sm-2 form-control-label">Video Format</label>
                                    <div class="col-sm-3">
                                        <select id="type" name="type" class="form-control">
                                            <option value="embed">Embed Code</option>
                                            <option value="file">Video File</option>
                                        </select>
                                    </div>
                                </div>
                                <hr/>
                                <div class="new_video_file" style="display: none">
                                    <div id="dZUpload" class="dropzone">
                                        <div class="dz-default dz-message">Drop files here to upload</div>
                                    </div>
                                </div>
                                <div class="new_video_embed" >
                                    <label for="embed_code">Embed Code:</label>
                                    <textarea class="form-control" name="embed_code" id="embed_code"></textarea>
                                </div>
                                </p>
                            </div>
                        </section>
                    </div>
                    <div class="col-xs-12 m-b-md">
                        <button type="submit" class="btn btn-rounded btn-inline btn-success pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop

@section('head')
    <link rel="stylesheet" href="{{ asset('wpanel/js/tagsinput/jquery.tagsinput.css') }}" />
    <link rel="stylesheet" href="{{ asset('wpanel/js/dropzone/dropzone.css') }}" />
@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('wpanel/js/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wpanel/js/input-mask/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wpanel/js/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript">
        $('#tags').tagsInput();
        $('#video-duration').mask('00:00:00', {placeholder: "__:__:__"});

        Dropzone.autoDiscover = false;

        $(function() {
            $('#type').change(function(){
                if($(this).val() == 'file'){
                    $('.new_video_file').show();
                    $('.new_video_embed').hide();
                } else {
                    $('.new_video_file').hide();
                    $('.new_video_embed').show();
                }
            });

            var baseUrl = "{{ url('/') }}";
            Dropzone.autoDiscover = false;
            $("#dZUpload").dropzone({
                url: baseUrl + "/admin/videos/upload",
                headers: {
                    'X-CSRF-Token': '{{ Session::getToken() }}'
                },
                maxFilesize : 1024,  // MB
                maxFiles : 1,
                paramName : "file",
                addRemoveLinks: true,
                success: function (file, response) {
                    console.log(response);
                }
            });
        });
    </script>
@stop