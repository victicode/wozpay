<template>
  <div 
    class="drop-zone"
    @dragover.prevent="dragover"
    @dragleave.prevent="dragleave"
    @drop.prevent="drop"
    :class="{ 'dragging': isDragging }"
  >
    <p class="text-subtitle1" v-if="!file" >Arrastra y suelta un archivo (Excel o JSON) aquí o haz clic para seleccionar</p>
    <p v-else class="text-subtitle1">Archivo subido✅</p>
    <input 
      type="file" 
      ref="fileInput"
      @change="onFileChange"
      accept=".xlsx, .xls, .csv, .json, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/json"
      style="display: none;"
    >
    <button @click="triggerFileInput">
      {{ !file ?'Seleccionar archivo' : 'Seleccionar otro archivo' }}
      
    </button>
    

  </div>
</template>

<script>
import * as XLSX from 'xlsx';

export default {
  name: 'FileDropZone',
  data() {
    return {
      isDragging: false,
      file: null,
      fileData: [],
      headers: [],
      fileType: null,
      jsonPreview: ''
    };
  },
  methods: {
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    dragover() {
      this.isDragging = true;
    },
    dragleave() {
      this.isDragging = false;
    },
    drop(e) {
      this.isDragging = false;
      const files = e.dataTransfer.files;
      if (files.length) {
        this.processFile(files[0]);
      }
    },
    onFileChange(e) {
      const files = e.target.files;
      if (files.length) {
        this.processFile(files[0]);
      }
    },
    async processFile(file) {
      // Verificar el tipo de archivo
      const excelTypes = [
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/csv'
      ];
      
      const jsonTypes = [
        'application/json'
      ];
      
      const isExcel = excelTypes.includes(file.type) || file.name.match(/\.(xlsx|xls|csv)$/);
      const isJson = jsonTypes.includes(file.type) || file.name.match(/\.json$/);
      
      if (!isExcel && !isJson) {
        alert('Por favor, sube un archivo válido (.xlsx, .xls, .csv o .json)');
        return;
      }
      
      this.file = file;
      this.fileType = isExcel ? 'excel' : 'json';
      
      try {
        if (this.fileType === 'excel') {
          const data = await this.readExcelFile(file);
          this.fileData = data;
          if (data.length > 0) {
            this.headers = Object.keys(data[0]);
          }
        } else {
          const data = await this.readJsonFile(file);
          this.fileData = Array.isArray(data) ? data : [data];
          this.jsonPreview = JSON.stringify(data, null, 2);
          if (this.fileData.length > 0) {
            this.headers = Object.keys(this.fileData[0]);
          }
        }
        
        // Emitir evento con los datos leídos
        this.$emit('file-loaded', {
          file: file,
          data: this.fileData,
          headers: this.headers,
          type: this.fileType
        });
      } catch (error) {
        console.error('Error al leer el archivo:', error);
        alert('Error al leer el archivo. Por favor, verifica el formato e intenta nuevamente.');
      }
    },
    readExcelFile(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        
        reader.onload = (e) => {
          const data = e.target.result;
          const workbook = XLSX.read(data, { type: 'array' });
          const firstSheetName = workbook.SheetNames[0];
          const worksheet = workbook.Sheets[firstSheetName];
          const jsonData = XLSX.utils.sheet_to_json(worksheet);
          resolve(jsonData);
        };
        
        reader.onerror = (error) => {
          reject(error);
        };
        
        reader.readAsArrayBuffer(file);
      });
    },
    readJsonFile(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        
        reader.onload = (e) => {
          try {
            const data = JSON.parse(e.target.result);
            resolve(data);
          } catch (parseError) {
            reject(parseError);
          }
        };
        
        reader.onerror = (error) => {
          reject(error);
        };
        
        reader.readAsText(file);
      });
    }
  }
};
</script>

<style scoped>
.drop-zone {
  border: 2px dashed #ccc;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
  margin: 20px 0;
  transition: all 0.3s ease;
}

.drop-zone.dragging {
  border-color: #4CAF50;
  background-color: #f8f8f8;
}

button {
  margin-top: 10px;
  padding: 8px 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.preview {
  margin-top: 20px;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

pre {
  text-align: left;
  background: #f4f4f4;
  padding: 10px;
  border-radius: 4px;
  max-height: 200px;
  overflow-y: auto;
}
</style>