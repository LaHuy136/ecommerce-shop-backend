@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', ['title' => 'Basic Form'])

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <h4 class="card-title">Default Forms</h4>
                    <h5 class="card-subtitle"> All bootstrap element classies </h5>
                    <form class="form-horizontal m-t-30">
                        <div class="form-group">
                            <label>Default Text <span class="help"> e.g. "George deo"</span></label>
                            <input type="text" class="form-control" value="George deo...">
                        </div>
                        <div class="form-group">
                            <label for="example-email">Email <span class="help"> e.g. "example@gmail.com"</span></label>
                            <input type="email" id="example-email" name="example-email" class="form-control"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" value="password">
                        </div>
                        <div class="form-group">
                            <label>Placeholder</label>
                            <input type="text" class="form-control" placeholder="placeholder">
                        </div>
                        <div class="form-group">
                            <label>Text area</label>
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Read only input</label>
                            <input class="form-control" type="text" placeholder="Readonly input here…" readonly>
                        </div>
                        <div class="form-group">
                            <fieldset disabled>
                                <label for="disabledTextInput">Disabled input</label>
                                <input type="text" id="disabledTextInput" class="form-control"
                                    placeholder="Disabled input">
                            </fieldset>
                        </div>
                        <div class="form-group row p-t-20">
                            <div class="col-sm-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Check this custom
                                        checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Check this custom
                                        checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Check this custom
                                        checkbox</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Toggle this custom radio</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Input Select</label>
                            <select class="custom-select col-12" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Default file upload</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Custom File upload</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Helping text</label>
                            <input type="text" class="form-control" placeholder="Helping text">
                            <span class="help-block"><small>A block of help text that breaks onto a new line and may extend
                                    beyond one line.</small></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
