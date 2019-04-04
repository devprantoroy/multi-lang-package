# Pranto Multilanguage
Pranto Multilanguage is a **dynamic multi-language** system. Where admin can easily add/romove language as he likes.
### Requirements
- PHP >= 5.4
### Composer Installation
Installation is straightforward, setup is similar to every other Laravel Package.

> `composer require pranto/multi-language`

**Note**: This package supports the new auto-discovery features of Laravel 5.5, so if you are working on a Laravel 5.5 project, then your install is complete, you can skip to step 3.

If you are using Laravel 5.0 - 5.4 then you need to add a provider and alias. Inside of your config/app.php define a new service provider

> `'providers' => [
>	Pranto\MultiLanguage\MultiLanguageServiceProvider::class,
> ];`

### How To Implement In View
This package is easy to use. It provides a handful of helpful functions for changing language. Add similar this code to frontend.

Make just a migration table: 

> `php artisan make:migration create_languages_table`

<div>

    $table->string('icon');
    $table->string('name');
    $table->string('code');
    
</div>

then run:

> `php artisan migrate`

Now add:

<div>

    <select id="langSel">
        <option style="color: black" value="en"> English</option>
        @foreach($lang as $data)
            <option value="{{$data->code}}" @if(Session::get('lang') === $data->code) selected  @endif style="color: black"><img src="{{ asset('assets/images/'.$data->icon)  }}"> {{$data->name}}</option>
        @endforeach
    </select>
    
</div>

And jQuery :
<div>

    $(document).on('change', '#langSel', function () {
        var code = $(this).val();
        window.location.href = "{{url('/')}}/change-lang/"+code ;
    });
</div>

Add similar this code to backend (Admin Panel):

-First create **"language"** folder inside of Laravel > resources > admin folder.
-create "lang.blade.php" & edit_lang.blade.php inside **""language"** folder.
   
#### lang.blade.php , add similar this code:
**Remember**: Watch route name. You can change you design pattern this code is showing for **route name** activities. 
**Add This Route/URL**: route('language-manage') / url('language/manager')

        <div class="tile">
                <div class="table-responsive">
                    <table class="table">
                            <h3>Language Manager <button data-toggle="modal" data-target="#myModal" class="btn btn-primary bold pull-right"><i class="fa fa-plus"></i> Add New Language</button></h3>
                            <br>
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($social as $product)
                            <tr>
                                <td><img src="{{asset('assets/images/'.$product->icon)}}"></td>
                                <td>{{$product->name}}</td>
                                <td style="font-size: 22px;">{!! $product->code !!}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('language-key', $product->id)}}"><i class="fa fa-code"></i> Keyword Edit</a>
                                    <a class="btn btn-primary" href="#editModal{{$product->id}}" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal{{$product->id}}"> <i class='fa fa-trash'></i> DELETE</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i>Edit Language</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form method="post" action="{{route('language-manage-update', $product->id)}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="modal-body">

                                                <div class="form-group error">
                                                    <div class="col-sm-12 mx-auto">
                                                        <img class="mx-auto" width="100px" src="{{asset('assets/images/'.$product->icon)}}">
                                                    </div>

                                                    <label for="inputName" class="col-sm-12 ">Flag Icon (PNG must) : </label>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control has-error bold " name="icon" >
                                                    </div>
                                                </div>
                                                <div class="form-group error">
                                                    <label for="inputName" class="col-sm-12 ">Language Name : </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-error bold " id="code" name="name"  value="{{$product->name}}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="DelModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <strong>Are you sure you want to Delete ?</strong>
                                        </div>

                                        <div class="modal-footer">
                                            <form method="post" action="{{route('language-manage-del', $product->id)}}" class="form-inline">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                <button type="submit" class="btn btn-danger deleteButton"><i class="fa fa-trash"></i> DELETE</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Add New Language</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{route('language-manage-store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group error">

                            <label for="inputName" class="col-sm-12 ">Flag Icon (PNG must) : </label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control has-error bold " name="icon">
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-12 ">Language Name : </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control has-error bold " id="code" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-12">Language Code : </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control has-error bold " id="link" name="code" value="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

#### edit_lang.blade.php , add similar this code:
**Remember**: Watch route name. You can change you design pattern this code is showing for **route name** activities. 

   
   
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="tile-title"> {{ $page_title }} (<small>Click Add Translatable Add Put Your Key For Translate</small>)</h3>
                        <small style="color: red">"Add Translatable Key" please careful when you entering word or sentences, there shouldn't be any extra space or break. </small>
                        <small style="color: green">If your keywords are perfect but translator doesn't work, don't worry. escape all dynamic keywords and add single word, it'll work  . </small>
                    </div>
                    <div class="col-md-4">
                        <form class="form-inline" method="post" @submit.prevent="importKey">
                            <div class="form-group mb-2">
                                <select  class="form-control" required v-model="importData.code">
                                    <option value="">Import Keywords (Select Language)</option>
                                    @foreach($list_lang as $data)
                                        <option value="{{$data->id}}" @if($data->id == $la->id) style="display: none" @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Import Now</button>
                        </form>
                        <small style="color: red">If you import keywords from another language, Your present "{{$la->name}}" all keywords will remove.</small>
                    </div>
                </div>
                <hr>
                <div class="tile-body" style="overflow: hidden">
                    <form method="post" action="{{route('key-update', $la->id)}}" id="langForm">
                        {{ csrf_field() }}
                        {{method_field('put')}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3" v-for="(value, key) in datas" :key="key">
                                    <label class="control-label">@{{ key }}</label>
                                    <div class="input-group">
                                        <input type="text" :value="value" :name="'keys[' + key + ']'" class="form-control">
                                        <div class="input-group-append" >
                                            <span class="input-group-text" style="background: #ff4f59; color: white" @click.prevent="deleteElement(key)"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-primary">Add Translatable Key</button>
                                    <button class="btn btn-success" data-toggle="tooltip" title="@lang('Save')" @click.prevent="save">Save</button>
                                </div>

                                <br>
                                <br>
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> Update</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newlangForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">English</label>
                            <input type="text" class="form-control" v-model="newKey" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{$la->name}}</label>
                            <input type="text" class="form-control" v-model="newVal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add Field" @click.prevent="addfield()">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
     <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>
    
        <script>
            window.app = new Vue({
                el: '#app',
                data: {
                    datas: {!! $json !!},
                    current: '{{ $la->code }}',
                    newVal: null,
                    newKey: null,
    
    
                    importData : {
                        code : ''
                    }
    
                },
                methods: {
                    save() {
                        $('#langForm').submit();
                    },
    
                    deleteElement(key) {
                        Vue.delete(this.datas, key);
                    },
                    addfield() {
                        Vue.set(this.datas, this.newKey, this.newVal);
                        app.newKey = '';
                        app.newVal = '';
                        // document.getElementById('newlangForm').reset();
                        $("#addModal").modal('hide');
                    },
                    importKey()
                    {
                        var code = this.importData;
                        axios.post('{{route('import_lang')}}', code).then(function (res) {
                            app.datas = res.data;
                        })
    
                    }
                }
            })
        </script>
    
    
** That's it, send mail for more detail "pranto101201@gmail.com" **
