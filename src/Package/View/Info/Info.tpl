{{R3M}}
{{$request = request()}}
Package: {{$request.package}}

Module: {{$request.module|uppercase.first}}

{{if(!is.empty($request.submodule))}}
Submodule: {{$request.submodule|uppercase.first}}

{{/if}}

{{binary()}} {{$request.package}} info
{{binary()}} {{$request.package}} list
{{binary()}} {{$request.package}} restart
{{binary()}} {{$request.package}} setup
