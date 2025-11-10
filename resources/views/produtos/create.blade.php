@extends('produtos.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 font-weight-light">Cadastrar Novo Produto</h3>
                        <a class="btn btn-light btn-sm" href="{{ route('produtos.index') }}">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Ops! Encontramos alguns problemas
                        </h5>
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                            <li><i class="fas fa-dot-circle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('produtos.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <!-- Descrição -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" 
                                           class="form-control @error('descricao') is-invalid @enderror" 
                                           id="descricao" 
                                           name="descricao" 
                                           placeholder="Descrição do produto"
                                           value="{{ old('descricao') }}"
                                           required>
                                    <label for="descricao">Descrição do Produto</label>
                                    @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantidade -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control @error('qtd') is-invalid @enderror" 
                                           id="qtd" 
                                           name="qtd" 
                                           placeholder="Quantidade"
                                           value="{{ old('qtd', 0) }}"
                                           min="0" 
                                           max="99999"
                                           required>
                                    <label for="qtd">Quantidade em Estoque</label>
                                    @error('qtd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Preço de Custo -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control @error('precoUnitario') is-invalid @enderror" 
                                           id="precoUnitario" 
                                           name="precoUnitario" 
                                           placeholder="Preço de custo"
                                           value="{{ old('precoUnitario') }}"
                                           step="0.01"
                                           min="0"
                                           required>
                                    <label for="precoUnitario">Preço de Custo (R$)</label>
                                    @error('precoUnitario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Preço de Venda -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control @error('precoVenda') is-invalid @enderror" 
                                           id="precoVenda" 
                                           name="precoVenda" 
                                           placeholder="Preço de venda"
                                           value="{{ old('precoVenda') }}"
                                           step="0.01"
                                           min="0"
                                           required>
                                    <label for="precoVenda">Preço de Venda (R$)</label>
                                    @error('precoVenda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ route('produtos.index') }}" 
                               class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Salvar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
    }
    .card {
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .btn-primary:hover {
        background-color: #224abe;
        border-color: #224abe;
    }
</style>
@endpush

@push('scripts')
<script>
    // Mascara para campos monetários
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function(e) {
            if (this.name.includes('preco')) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    });

    // Validação do formulário
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
@endsection