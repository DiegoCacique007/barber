@extends('layouts.administrador')

@section('title', 'Editar red social')

@push('styles')
    <style>
        .red-page-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}

        .btn-volver{min-height:40px;display:inline-flex;align-items:center;justify-content:center;padding:0 15px;border:1px solid rgba(255,255,255,.15);border-radius:9px;background:#1a1a1a;color:#bbb;font-size:11px;text-decoration:none;transition:.2s}

        .btn-volver:hover{border-color:rgba(213,173,85,.25);color:#fff}

        .red-form-card{width:100%;padding:32px;border:1px solid rgba(255,255,255,.10);border-radius:18px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.12)}

        .red-form-content{display:grid;grid-template-columns:1fr 1fr;gap:24px}

        .form-section{padding:24px;border:1px solid rgba(255,255,255,.08);border-radius:16px;background:#171717}

        .form-section-header{display:flex;align-items:center;gap:13px;margin-bottom:24px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.07)}

        .section-icon{width:42px;height:42px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(213,173,85,.18);border-radius:11px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:16px}

        .form-section-header h5{margin:0;color:#fff;font-size:15px;font-weight:700}

        .form-section-header p{margin:4px 0 0;color:#999;font-size:11px}

        .form-fields{display:flex;flex-direction:column;gap:20px}

        .form-group-custom label{display:block;margin-bottom:8px;color:#d8d8d8;font-size:12px;font-weight:600}

        .form-group-custom .form-control{width:100%;min-height:48px;border:1px solid rgba(255,255,255,.14)!important;border-radius:10px!important;background:#202020!important;color:#fff!important;font-size:13px}

        .form-group-custom .form-control::placeholder{color:#888!important}

        .form-group-custom .form-control:focus{border-color:#d5ad55!important;background:#222!important;color:#fff!important;box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important}

        .form-help{display:block;margin-top:7px;color:#969696;font-size:10px}

        .form-error{margin-top:6px;color:#efa0a7;font-size:11px}

        .estado-red{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:16px;border:1px solid rgba(255,255,255,.08);border-radius:12px;background:#1d1d1d}

        .estado-red strong{display:block;color:#eee;font-size:12px;font-weight:600}

        .estado-red span{display:block;margin-top:4px;color:#999;font-size:10px;line-height:1.4}

        .form-check-input{width:2.4em!important;height:1.2em!important;cursor:pointer}

        .form-check-input:checked{border-color:#d5ad55!important;background-color:#d5ad55!important}

        .form-check-input:focus{box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important}

        .red-form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:28px;padding-top:22px;border-top:1px solid rgba(255,255,255,.07)}

        .btn-form-primary,
        .btn-form-secondary{min-height:44px;display:inline-flex;align-items:center;justify-content:center;padding:0 18px;border-radius:10px;font-size:12px;font-weight:600;text-decoration:none;transition:.2s}

        .btn-form-primary{border:1px solid #d5ad55;background:#d5ad55;color:#111}

        .btn-form-primary:hover{border-color:#e8c873;background:#e8c873;color:#111}

        .btn-form-secondary{border:1px solid rgba(255,255,255,.14);background:#202020;color:#bbb}

        .btn-form-secondary:hover{border-color:rgba(213,173,85,.25);color:#fff}

        @media(max-width:992px){
            .red-form-content{grid-template-columns:1fr}
        }

        @media(max-width:600px){
            .red-page-header{align-items:flex-start;flex-direction:column}
            .red-form-card{padding:22px}
            .form-section{padding:18px}
            .red-form-actions{flex-direction:column-reverse}
            .btn-form-primary,.btn-form-secondary,.btn-volver{width:100%}
        }
    </style>
@endpush

@section('content')

    <div class="red-page-header">

        <div class="page-header mb-0">

            <h1>
                Editar red social
            </h1>

            <p>
                Actualiza la información de {{ $redSocial->nombre }}.
            </p>

        </div>

        <a href="{{ route('administrador.redes.index') }}"
           class="btn-volver">
            Volver
        </a>

    </div>

    <div class="red-form-card">

        <form method="POST"
              action="{{ route('administrador.redes.update', $redSocial) }}">

            @csrf
            @method('PUT')

            @include('administrador.redes.form')

        </form>

    </div>

@endsection
