@extends('layouts.app')

@section('title', 'Results - PneumoFusion')

@push('styles')
<style>
.results-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.results-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    align-items: stretch; /* Changed from 'start' to 'stretch' */
}

.card-box {
    background: var(--card);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid var(--border);
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
    min-height: 100%; /* Added */
}

.card-box:hover {
    transform: translateY(-4px);
}

.upload-title {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.upload-area {
    border: 2px dashed var(--border);
    border-radius: 20px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    min-height: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: 0.3s ease;
    overflow: hidden;
}

.upload-area.dragover {
    border-color: #667eea;
    background: rgba(102,126,234,0.05);
}

.upload-area img {
    max-width: 100%;
    max-height: 260px;
    object-fit: contain;
    border-radius: 15px;
}

.upload-placeholder {
    transition: 0.3s;
}

.upload-icon {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-input {
    display: none;
}

.upload-button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 20px;
    transition: 0.3s;
}

.upload-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102,126,234,0.4);
}

.upload-button:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.result-label {
    
    font-size: 0.85rem;
    opacity: 0.7;
    margin-top: 15px;
}

.result-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.result-value.normal {
    color: #48bb78;
}

.result-value.pneumonia {
    color: #f56565;
}

.confidence-bar {
    background: rgba(0,0,0,0.08);
    border-radius: 12px;
    height: 28px;
    overflow: hidden;
    margin-bottom: 20px;
}

.confidence-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    transition: width 0.6s ease;
}

.result-message {
    background: rgba(102,126,234,0.08);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.probabilities {
    background: rgba(0,0,0,0.05);
    padding: 15px;
    border-radius: 12px;
}

.prob-item {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
}

.loading-spinner {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.loading-box {
    background: var(--card);
    padding: 40px;
    border-radius: 20px;
    text-align: center;
}

.spinner {
    border: 4px solid rgba(0,0,0,0.1);
    border-left-color: #667eea;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

@media (max-width: 1024px) {
    .results-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush


@section('content')
<div class="results-container">
    <div class="results-grid">
        
        <!-- LEFT: UPLOAD -->
        <div class="card-box">
            <h2 class="upload-title">Upload Chest X-Ray</h2>

            <div class="upload-area" id="uploadArea">
                
               <!-- Placeholder Content -->
<div class="upload-placeholder" id="uploadPlaceholder">
    <div class="upload-icon">
        <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="64" height="64" rx="16" fill="url(#grad)"/>
            <path d="M32 18V42M32 18L24 26M32 18L40 26" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 46H46" stroke="white" stroke-width="3" stroke-linecap="round"/>
            <defs>
                <linearGradient id="grad" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#667eea"/>
                    <stop offset="1" stop-color="#764ba2"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
    <p style="margin-top: 12px; font-weight: 600; font-size: 1rem;">Click or Drag & Drop to Upload</p>
    <small style="opacity: 0.6; margin-top: 6px; display:block;">JPG, JPEG, PNG Supported</small>
</div>

                <!-- Preview Image Inside Upload Box -->
                <img id="previewImage" 
                     style="display:none; max-width:100%; max-height:260px; object-fit:contain; border-radius:15px;">
            </div>

            <input type="file" id="fileInput" class="file-input" accept="image/*">

            <button class="upload-button" id="uploadButton" disabled>
                Analyze X-Ray
            </button>
        </div>

        <!-- RIGHT: RESULTS -->
        <div class="card-box">
            <p class="result-label">Diagnosis</p>
            <h2 class="result-value" id="resultDiagnosis">-</h2>

            <p class="result-label">Confidence</p>
            <div class="confidence-bar">
                <div class="confidence-fill" id="confidenceFill" style="width:0%">
                    
                </div>
            </div>

            <div class="result-message" id="resultMessage">
                <p>Upload an X-Ray to see results</p>
            </div>

            <div class="probabilities">
                <div class="prob-item">
                    <span>Normal:</span>
                    <strong id="probNormal">-</strong>
                </div>
                <div class="prob-item">
                    <span>Pneumonia:</span>
                    <strong id="probPneumonia">-</strong>
                </div>
            </div>
        </div>

    </div>

    <!-- LOADING SPINNER -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="loading-box">
            <div class="spinner"></div>
            <p>AI is analyzing X-Ray...</p>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
let selectedFile = null;
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const previewImage = document.getElementById('previewImage');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');
const uploadButton = document.getElementById('uploadButton');
const spinner = document.getElementById('loadingSpinner');

// CLICK upload
uploadArea.addEventListener('click', () => fileInput.click());

// FILE INPUT change
fileInput.addEventListener('change', (e) => handleFile(e.target.files[0]));

// DRAG & DROP
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    handleFile(e.dataTransfer.files[0]);
});

// HANDLE FILE: preview + enable button
function handleFile(file) {
    if (!file || !file.type.startsWith('image/')) return;

    selectedFile = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
        uploadPlaceholder.style.display = 'none';
    };
    reader.readAsDataURL(file);

    uploadButton.disabled = false;
}

// UPLOAD BUTTON CLICK
uploadButton.addEventListener('click', async () => {
    if (!selectedFile) return;

    spinner.style.display = 'flex';
    uploadButton.disabled = true;

    const formData = new FormData();
    formData.append('xray_image', selectedFile);

    try {
        const response = await fetch('{{ route("results.analyze") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });

        const result = await response.json();
        spinner.style.display = 'none';

        if (result.success && result.data) {
            const data = result.data;

            // Diagnosis
            const diagEl = document.getElementById('resultDiagnosis');
            diagEl.textContent = data.prediction;
            diagEl.className = 'result-value ' + (data.prediction === 'NORMAL' ? 'normal' : 'pneumonia');

            // Confidence
            const conf = Math.round(data.confidence * 100);
            const confEl = document.getElementById('confidenceFill');
            confEl.style.width = conf + '%';
            confEl.textContent = conf + '%';

            // Result message
            document.getElementById('resultMessage').innerHTML = '<p>' + data.message + '</p>';

            // Probabilities
            document.getElementById('probNormal').textContent = (data.all_probabilities.NORMAL * 100).toFixed(2) + '%';
            document.getElementById('probPneumonia').textContent = (data.all_probabilities.PNEUMONIA * 100).toFixed(2) + '%';

            uploadButton.disabled = false;
        } else {
            alert(result.message || 'Error');
            uploadButton.disabled = false;
        }

    } catch (error) {
        spinner.style.display = 'none';
        alert('Network error');
        uploadButton.disabled = false;
    }
});
</script>
@endpush
