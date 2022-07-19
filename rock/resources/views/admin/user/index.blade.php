@extends('admin.layouts.common')
@section('title', 'User')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li class="active">
                <strong>User</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            @if($errors->any())
            <div class="alert alert-danger">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{$errors->first()}}
            </div>
            @endif
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {!! \Session::get('success') !!}
            </div>
            @endif

            @if (\Session::has('error'))
            <div class="alert alert-danger">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {!! \Session::get('error') !!}
            </div>
            @endif

            <div class="ibox float-e-margins">
                <div class="ibox-content boder-none" style="margin-top:10px;">
                    <div class="ibox-title">
                        <h2>User Detail</h2>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Frist Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>User Status</th>
                            <th>Versicherungsmakler</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($result) && !empty($result))
                            <?php $no = 1;?>
                                @foreach ($result as $key => $value)
                                    <?php //dd($value);?>
                                    @if(isset($value) && !empty($value))
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td> {{$value->user_name}}</td>
                                            <td> {{$value->last_name}} </td>
                                            <td> {{$value->email}} </td>
                                            <td>
                                                @if($value->admin_confirm == 1)
                                                    <span class="label label-primary">Active</span>
                                                @else
                                                    <span class="label label-warning-light">DeActive</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if($value->broker == 'yes')
                                                    <span class="label label-primary">Yes</span>
                                                @else
                                                    <span class="label label-warning-light">No</span>

                                                @endif
                                            </td>
                                            <td>
                                                <a href="{!!url('admin/user-detail') !!}/{{$value->id }}" class="btn btn-small btn-success display-none">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <a href="javascript:void(0)" class="btn btn-small btn-success" data-toggle="modal" data-target="#edit_modal_edit_{{$key}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <div class="modal fade" id="edit_modal_edit_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel">User Profile Information</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                @php
                                                                    $id = $value->id;
                                                                    $value_user = App\Models\UserDetail::where('user_id', $id)->first();
                                                                @endphp
                                                                <div class="row">
                                                                    <div class="col-sm-12 form-group">
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Nachname</label></td>
                                                                                <td>@if(isset($value->user_name) && !empty($value->user_name)){{$value->user_name}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Vorname</label></td>
                                                                                <td>@if(isset($value->last_name) && !empty($value->last_name)){{$value->last_name}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>E-Mail</label></td>
                                                                                <td>@if(isset($value->email) && !empty($value->email)){{$value->email}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Telefon</label></td>
                                                                                <td>@if(isset($value->phone) && !empty($value->phone)){{$value->phone}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Frau/Herr</label></td>
                                                                                <td>@if(isset($value->mr_mrs) && !empty($value->mr_mrs)){{$value->mr_mrs}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Versicherungsmakler</label></td>
                                                                                <td>@if(isset($value->broker) && !empty($value->broker)){{$value->broker}}  @endif
                                                                                    <div style="display: inline-block;float: right;">
                                                                                    @if($value->broker == 'yes')
                                                                                        <a href="javascript:void(0)" class="btn btn-small btn-success" onclick="ActionBrokerYes('{{$value->id}}');">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="javascript:void(0)" class="btn btn-small btn-success" onclick="ActionBrokerNo('{{$value->id}}');">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                    </div>
                                                                            </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Ich bin auf GLV Tippgeber aufmerksam geworden durch:</label></td>
                                                                                <td>
                                                                                    @if ($value->GLV_tipsters == '1')
                                                                                        Durch die Facebook-Gruppe „Versicherungsvermittler Deutschland“
                                                                                    @elseif ($value->GLV_tipsters == '2')
                                                                                        Durch die Facebook-Gruppe „Versicherungsmaklerforum Deutschland“
                                                                                    @elseif ($value->GLV_tipsters == '3')
                                                                                        Empfohlen von :{{ $value->Empfohlen_von_detail }}
                                                                                    @else
                                                                                        Sonstiges: {{ $value->Sonstiges_detail }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Anmerkung</label></td>
                                                                                <td>@if(isset($value->anmerkung) && !empty($value->anmerkung)){{$value->anmerkung}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>E-Mail für Abrechnung</label></td>
                                                                                <td>@if(isset($value_user->email2) && !empty($value_user->email2)){{$value_user->email2}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>IBAN</label></td>
                                                                                <td>@if(isset($value_user->iban) && !empty($value_user->iban)){{$value_user->iban}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Kontoinhaber</label></td>
                                                                                <td>@if(isset($value_user->kontoinhaber) && !empty($value_user->kontoinhaber)){{$value_user->kontoinhaber}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Weitere Ansdprechpartner </label></td>
                                                                                <td>@if(isset($value_user->weitere) && !empty($value_user->weitere)){{$value_user->weitere}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Frau</label></td>
                                                                                <td>@if(isset($value_user->frau1) && !empty($value_user->frau1)){{$value_user->frau1}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Unternehmen / Firmierung</label></td>
                                                                                <td>@if(isset($value_user->unternehmen) && !empty($value_user->unternehmen)){{$value_user->unternehmen}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Straße, Hausnummer</label></td>
                                                                                <td>@if(isset($value_user->strabe) && !empty($value_user->strabe)){{$value_user->strabe}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>PLZ + Ort</label></td>
                                                                                <td>@if(isset($value_user->plzort) && !empty($value_user->plzort)){{$value_user->plzort}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Geburtsdatum</label></td>
                                                                                <td>@if(isset($value_user->geburtsdatum) && !empty($value_user->geburtsdatum)){{$value_user->geburtsdatum}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>IHK Registrierungsnummer</label></td>
                                                                                <td>@if(isset($value_user->ihkregister) && !empty($value_user->ihkregister)){{$value_user->ihkregister}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Beginn des Tippgeber-Vertrages</label></td>
                                                                                <td>@if(isset($value_user->beginndes) && !empty($value_user->beginndes)){{$value_user->beginndes}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Name der Bank</label></td>
                                                                                <td>@if(isset($value_user->bankdetail) && !empty($value_user->bankdetail)){{$value_user->bankdetail}}  @endif</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>Sonstige Anmerkungen</label></td>
                                                                                <td>@if(isset($value_user->sonsge) && !empty($value_user->sonsge)){{$value_user->sonsge}}  @endif</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td style="width: 35%;"><label>VERTRIEBSVEREINBARUNG</label></td>
                                                                                <td>
                                                                                    @if(isset($value_user['distribution_status']))
                                                                                        @if($value_user['distribution_status'] == 1 )
                                                                                            @if(isset($value_user->distribution) && !empty($value_user->distribution)){{$value_user->distribution}} @endif
                                                                                        @else
                                                                                            file not upload
                                                                                        @endif
                                                                                        @php
                                                                                            $file_path = 'javascript:void(0)';
                                                                                            if(isset($value_user->distribution) && !empty($value_user->distribution)){
                                                                                                $name = $value_user->distribution;
                                                                                                $url = URL::asset('uploads').'/'.$id;
                                                                                                $file_path = $url.'/'.$name;
                                                                                            }
                                                                                        @endphp
                                                                                        @if($value_user['distribution_status'] == 1)
                                                                                            <div style="float: right;">
                                                                                                <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                                                                    <i class="fa fa-download"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>VERTRAULICHKEITSVERPFLICHTUNG</label></td>
                                                                                <td>
                                                                                    @if(isset($value_user['confidentiality_status']))
                                                                                        @if($value_user['confidentiality_status'] == 1 )
                                                                                            @if(isset($value_user->confidentiality) && !empty($value_user->confidentiality)){{$value_user->confidentiality}} @endif
                                                                                        @else
                                                                                            file not upload
                                                                                        @endif
                                                                                        @php
                                                                                            $file_path = 'javascript:void(0)';
                                                                                            if(isset($value_user->confidentiality) && !empty($value_user->confidentiality)){
                                                                                                $name = $value_user->confidentiality;
                                                                                                $url = URL::asset('uploads').'/'.$id;
                                                                                                $file_path = $url.'/'.$name;
                                                                                            }
                                                                                        @endphp
                                                                                        @if($value_user['confidentiality_status'] == 1)
                                                                                            <div style="float: right;">
                                                                                                <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                                                                    <i class="fa fa-download"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 35%;"><label>AVV VERTRAG</label></td>
                                                                                <td>
                                                                                    @if(isset($value_user['avv_contract_status']))
                                                                                        @if($value_user['avv_contract_status'] == 1 )
                                                                                            @if(isset($value_user->avv_contract) && !empty($value_user->avv_contract)){{$value_user->avv_contract}} @endif
                                                                                        @else
                                                                                            file not upload
                                                                                        @endif
                                                                                        @php
                                                                                            $file_path = 'javascript:void(0)';
                                                                                            if(isset($value_user->avv_contract) && !empty($value_user->avv_contract)){
                                                                                                $name = $value_user->avv_contract;
                                                                                                $url = URL::asset('uploads').'/'.$id;
                                                                                                $file_path = $url.'/'.$name;
                                                                                            }
                                                                                        @endphp
                                                                                        @if($value_user['avv_contract_status'] == 1)
                                                                                            <div style="float: right;">
                                                                                                <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                                                                    <i class="fa fa-download"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($value->admin_confirm == 0)
                                                <a href="javascript:void(0)" class="btn btn-small btn-primary" onclick="ActionConfim('{{$value->id}}');" style="margin-left:5px;">
                                                    Active
                                                </a>
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-small btn-warning" onclick="ActionDeactive('{{$value->id}}');" style="margin-left:5px;">
                                                    DeActive
                                                </a>
                                                @endif
                                                <!-- <a href="javascript:void(0)" class="btn btn-small btn-danger" onclick="DeleteData('{{$value->id}}');" style="margin-left:5px;">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <?php $no++;?>
                                    @endif
                                @endforeach
                            @endif

                            {{-- {{ $result->links() }}--}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('footerscripts')
    <script src="{{admin_assets}}/js/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({height: 200});

       });
    </script>
    <script type="text/javascript">
        $('.table').DataTable({
          "lengthMenu": [5, 10, 15, 20, 50, 100, 150, 200],
          "pageLength": 15
        });
        function DeleteData(del_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "Are you delete this user detail?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/delete-user')}}",
                        data: {'id':del_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Deleted!", "User deleted.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
        function ActionConfim(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This User is active?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/active-user')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Actived!", "User actived success.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
        function ActionDeactive(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This User is Deactive?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/active-user-deactive')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("De-Actived!", "User Deactived success.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }

        function ActionBrokerYes(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This Versicherungsmakler is No?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/active-borker')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Actived!", "Versicherungsmakler no success.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
        function ActionBrokerNo(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This Versicherungsmakler is Yes?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/deactive-borker')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Actived", "Versicherungsmakler yes success.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
    </script>
@stop
