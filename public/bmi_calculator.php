<?php include 'header.php'; ?>

<div class="container py-5" style="min-height: 80vh; max-width: 600px;">
    <h1 class="mb-4 text-center" style="font-family: 'Montserrat', sans-serif; color: #1A73E8;">Calculadora IMC</h1>

    <form id="bmiForm" novalidate>
        <div class="mb-3">
            <label for="weight" class="form-label">Peso (kg)</label>
            <input type="number" class="form-control" id="weight" min="1" step="0.1" required />
        </div>
        <div class="mb-3">
            <label for="height" class="form-label">Altura (cm)</label>
            <input type="number" class="form-control" id="height" min="30" step="0.1" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">Calcular IMC</button>
    </form>

    <div id="result" class="mt-4 text-center" style="font-family: 'Open Sans', sans-serif; font-size: 1.25rem;"></div>
</div>

<script>
    document.getElementById('bmiForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const weight = parseFloat(document.getElementById('weight').value);
        const heightCm = parseFloat(document.getElementById('height').value);

        if (!weight || !heightCm) {
            alert('Por favor, ingresa valores válidos para peso y altura.');
            return;
        }

        const heightM = heightCm / 100;
        const bmi = weight / (heightM * heightM);
        let category = '';

        if (bmi < 18.5) {
            category = 'Bajo peso';
        } else if (bmi < 25) {
            category = 'Peso normal';
        } else if (bmi < 30) {
            category = 'Sobrepeso';
        } else {
            category = 'Obesidad';
        }

        document.getElementById('result').textContent = `Tu IMC es ${bmi.toFixed(2)} (${category})`;
    });
</script>

<?php include 'footer.php'; ?>
