{{R3M}}
{{$request = request()}}
Package: {{$request.package}}

Module: {{$request.module|uppercase.first}}

{{if(!is.empty($request.submodule))}}
Submodule: {{$request.submodule|uppercase.first}}

{{/if}}

{{binary()}} {{$request.package}} {{$request.module}} info
{{binary()}} {{$request.package}} {{$request.module}} list
{{binary()}} {{$request.package}} {{$request.module}} restart
{{binary()}} {{$request.package}} {{$request.module}} setup
