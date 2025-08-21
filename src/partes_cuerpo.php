   
<style>
    .human-body svg {
        width: 80%;
        height: auto;
        max-width: 581px;
        cursor: pointer;
    }
    .human-body svg path {
        transition: fill 0.3s ease;
        fill: #999;
    }
    .human-body svg path:hover {
        fill: #a80000;
    }
    .human-body svg path.selected {
        fill: #dc3545 !important;
    }
    .selected-parts {
        max-height: 400px;
        overflow-y: auto;
    }
    .part-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 8px 12px;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .part-item:hover {
        background: #e9ecef;
    }
    .remove-part {
        color: #dc3545;
        cursor: pointer;
        font-weight: bold;
    }
    .remove-part:hover {
        color: #a02622;
    }
</style>

<div class="container-fluid py-0 row" id="app">
    <!-- Card principal -->
    <div class="card shadow">
        <div class="card-body"style="border:none">
            <!-- Información de partes seleccionadas -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h6 class="mb-1">
                            <i class="fas fa-hand-pointer me-2"></i>
                            Seleccionar Partes del Cuerpo Afectadas
                        </h6>
                    </div>
                </div>
            </div>
            <!-- Contenedor del cuerpo -->
            <div class="row">
                <!-- Cambiar col-6 por col-12 col-md-6 para que en móviles sea full width -->
                <div class="col-12 col-md-6 mb-3">
                    <div class="bg-light rounded p-2 text-center">
                        <h6 class="mb-2">
                            Vista Frontal <span class="text-muted mx-5 px-3"></span> Vista Posterior
                        </h6>
                        <div class="human-body d-inline-block" @click="part_clicked">                                            
                            <?php include '../public/assets/img/svg-cuerpo.svg'; ?>
                        </div>
                    </div>
                </div>
                <!-- Cambiar col-6 por col-12 col-md-6 para que en móviles sea full width -->
                <div class="col-12 col-md-6">
                    <div class="bg-light rounded p-3">
                        <h6 class="mb-3">
                            <i class="fas fa-list me-2"></i>
                            Partes Seleccionadas 
                            <span class="badge bg-primary">{{ selectedParts.length }}</span>
                        </h6>
                        
                        <div v-if="selectedParts.length === 0" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                            <p class="mb-0">No hay partes seleccionadas</p>
                            <small>Haga clic en el cuerpo humano para seleccionar</small>
                        </div>
                        
                        <div v-else class="selected-parts">
                            <div v-for="(part, index) in selectedParts" :key="index" class="part-item">
                                <span class="text-capitalize">
                                    <i class="fas fa-dot-circle me-2 text-danger"></i>
                                    {{ part }}
                                </span>
                                <span class="remove-part" @click="removePart(index)" title="Quitar parte">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div v-if="selectedParts.length > 0" class="mt-3">
                            <button class="btn btn-outline-danger btn-sm" @click="clearAll()">
                                <i class="fas fa-trash me-1"></i>Limpiar Todo
                            </button>
                        </div>
                        
                        <!-- Input oculto para enviar con el formulario -->
                        <input type="hidden" id="partes_afectadas" name="partes_afectadas" :value="selectedParts.join(', ')">
                    </div>
                </div>
            </div>
            
        </div>            
    </div>
</div>
    
<script>
    // Crear instancia Vue accesible globalmente
    window.vueApp = new Vue({
        el: "#app",
        data: {
            selectedParts: [],
            selectedElements: []
        },
        methods: {
            part_clicked(event) {
                const clickedElement = event.target;
                if (clickedElement.tagName === 'path' && clickedElement.id) {
                    // Usar el atributo data-parte si existe, si no, usar el id con espacios
                    const partName = clickedElement.getAttribute('data-parte') || clickedElement.id.replace(/-/g, ' ');
                    
                    // Verificar si la parte ya está seleccionada
                    const partIndex = this.selectedParts.indexOf(partName);
                    
                    if (partIndex === -1) {
                        // Agregar parte si no está seleccionada
                        this.selectedParts.push(partName);
                        this.selectedElements.push(clickedElement);
                        clickedElement.classList.add('selected');
                        
                    } else {
                        // Quitar parte si ya está seleccionada
                        this.selectedParts.splice(partIndex, 1);
                        this.selectedElements.splice(partIndex, 1);
                        clickedElement.classList.remove('selected');
                        

                    }
                    
                }
            },
            
            removePart(index) {
                const partName = this.selectedParts[index];
                const element = this.selectedElements[index];
                
                // Remover de las listas
                this.selectedParts.splice(index, 1);
                this.selectedElements.splice(index, 1);
                
                // Quitar clase CSS del elemento SVG
                if (element) {
                    element.classList.remove('selected');
                }
                

            },
            
            clearAll() {
                // Quitar clase CSS de todos los elementos
                this.selectedElements.forEach(element => {
                    if (element) {
                        element.classList.remove('selected');
                    }
                });
                
                // Limpiar arrays
                this.selectedParts = [];
                this.selectedElements = [];
                
            }
        }
    });

    document.querySelectorAll('#cuerpo-humano path').forEach(function(path) {
        path.addEventListener('click', function() {
            path.classList.toggle('selected');
            // Opcional: cambia el color al seleccionar
            if (path.classList.contains('selected')) {
                path.style.fill = '#ff9800'; // Naranja al seleccionar
            } else {
                path.style.fill = '#ccc'; // Color original al deseleccionar
            }
        });
    });

    const partesSeleccionadas = document.querySelectorAll('#cuerpo-humano path.selected');
    const partesAfectadas = Array.from(partesSeleccionadas).map(el => el.getAttribute('data-parte')).join(',');
    jsonData.partes_afectadas = partesAfectadas;
</script>