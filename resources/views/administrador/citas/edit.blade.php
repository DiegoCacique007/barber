@extends('layouts.administrador')

@section('title', 'Editar cita')

@push('styles')
    <style>
        .cita-page-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}

        .cita-header-actions{display:flex;gap:9px}

        .btn-volver,.btn-ver{min-height:40px;display:inline-flex;align-items:center;justify-content:center;padding:0 15px;border:1px solid rgba(255,255,255,.15);border-radius:9px;background:#1a1a1a;color:#bbb;font-size:11px;text-decoration:none;transition:.2s}

        .btn-volver:hover,.btn-ver:hover{border-color:rgba(213,173,85,.25);color:#fff}

        .cita-form-card{padding:27px;border:1px solid rgba(255,255,255,.10);border-radius:16px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.12)}

        .cita-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px}

        .form-section{padding:22px;border:1px solid rgba(255,255,255,.08);border-radius:14px;background:#171717}

        .form-section-header{display:flex;align-items:center;gap:13px;margin-bottom:24px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.07)}

        .section-icon{width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(213,173,85,.18);border-radius:10px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:16px}

        .form-section-header h5{margin:0;color:#fff;font-size:14px;font-weight:600}
        .form-section-header p{margin:4px 0 0;color:#999;font-size:10px}

        .form-fields{display:flex;flex-direction:column;gap:20px}
        .form-row-custom{display:grid;grid-template-columns:1fr 1fr;gap:15px}

        .form-group-custom label{display:block;margin-bottom:8px;color:#d0d0d0;font-size:11px;font-weight:600}

        .form-group-custom .form-control,
        .form-group-custom .form-select{width:100%;min-height:45px;border:1px solid rgba(255,255,255,.14)!important;border-radius:9px!important;background:#202020!important;color:#fff!important;font-size:12px;color-scheme:dark}

        .form-group-custom .form-control::placeholder{color:#888!important}

        .form-group-custom .form-control:focus,
        .form-group-custom .form-select:focus{border-color:#d5ad55!important;background:#222!important;color:#fff!important;box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important}

        .form-group-custom .form-select option{background:#202020;color:#fff}

        .form-error{margin-top:6px;color:#efa0a7;font-size:10px}

        .cita-form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:25px;padding-top:20px;border-top:1px solid rgba(255,255,255,.07)}

        .btn-form-primary,.btn-form-secondary{min-height:42px;display:inline-flex;align-items:center;justify-content:center;padding:0 18px;border-radius:9px;font-size:11px;font-weight:600;text-decoration:none;transition:.2s}

        .btn-form-primary{border:1px solid #d5ad55;background:#d5ad55;color:#111}
        .btn-form-primary:hover{border-color:#e8c873;background:#e8c873;color:#111}

        .btn-form-secondary{border:1px solid rgba(255,255,255,.14);background:#202020;color:#bbb}
        .btn-form-secondary:hover{border-color:rgba(213,173,85,.25);color:#fff}

        @media(max-width:950px){
            .cita-form-grid{grid-template-columns:1fr}
        }

        @media(max-width:600px){
            .cita-page-header{align-items:flex-start;flex-direction:column}
            .cita-header-actions{width:100%}
            .btn-volver,.btn-ver{flex:1}
            .cita-form-card{padding:20px}
            .form-section{padding:18px}
            .form-row-custom{grid-template-columns:1fr}
            .cita-form-actions{flex-direction:column-reverse}
            .btn-form-primary,.btn-form-secondary{width:100%}
        }
    </style>
@endpush

@section('content')

    <div class="cita-page-header">

        <div class="page-header mb-0">

            <h1>Editar cita</h1>

            <p>
                Actualiza la información de la reservación seleccionada.
            </p>

        </div>


        <div class="cita-header-actions">

            <a href="{{ route('administrador.citas.index') }}"
               class="btn-volver">
                Volver
            </a>

            <a href="{{ route('administrador.citas.show',$cita) }}"
               class="btn-ver">
                Ver
            </a>

        </div>

    </div>


    <div class="cita-form-card">

        <form method="POST"
              action="{{ route('administrador.citas.update',$cita) }}">

            @csrf
            @method('PUT')

            @include('administrador.citas.form')

        </form>

    </div>

@endsection
