document.addEventListener('DOMContentLoaded', function() {
    const deptSelect = document.getElementById('department');
    const docSelect = document.getElementById('doctor');
    const dateInput = document.getElementById('date');
    const slotsDiv = document.getElementById('slots');
    const slotIdInput = document.getElementById('slot_id');

    if(deptSelect) {
        deptSelect.addEventListener('change', function() {
            fetch(window.BASE_URL + 'api/doctors/' + this.value)
            .then(res => res.json())
            .then(data => {
                docSelect.innerHTML = '<option value="">Select Doctor</option>';
                data.forEach(doc => {
                    docSelect.innerHTML += `<option value="${doc.id}">${doc.name}</option>`;
                });
            });
        });
    }

    function fetchSlots() {
        if(docSelect.value && dateInput.value) {
            fetch(window.BASE_URL + 'api/slots/' + docSelect.value + '/' + dateInput.value)
            .then(res => res.json())
            .then(data => {
                slotsDiv.innerHTML = '';
                if(data.length === 0) {
                    slotsDiv.innerHTML = '<p class="text-danger">No slots available.</p>';
                    return;
                }
                data.forEach(slot => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-outline-success m-1';
                    btn.innerText = slot.start_time;
                    btn.onclick = function() {
                        document.querySelectorAll('#slots .btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        slotIdInput.value = slot.id;
                    };
                    slotsDiv.appendChild(btn);
                });
            });
        }
    }

    if(docSelect) docSelect.addEventListener('change', fetchSlots);
    if(dateInput) dateInput.addEventListener('change', fetchSlots);
    
    if(slotsDiv) {
        setInterval(fetchSlots, 10000);
    }
});