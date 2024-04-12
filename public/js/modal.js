async function handleModal(url){
    try {
        let res = await fetch(url);
        if (res.status == 200) {
            let data = await res.json();
            debugger;
            let modalDiv = document.getElementById('mainModal');
            modalDiv.innerHTML = data.page;
            modalDiv.classList.add('show'); // Show the modal
            modalDiv.style.display = 'block'; // Ensure modal is displayed
            document.body.classList.add('modal-open'); // Prevent scrolling behind modal
            let backdropDiv = document.createElement('div');
            backdropDiv.classList.add('modal-backdrop', 'fade', 'show');
            document.body.appendChild(backdropDiv);
        }
    } catch (error) {
        console.log(error);
    }
}

async function handleDB(url,formId,userId = null,token){
    let form = document.getElementById(formId);
    let formData = new FormData(form);

    // Validate fields
    let entries = [...formData.entries()];
    debugger
    let validationRes = validateForm(entries);
    if (validationRes > 0) {
        document.getElementById('errorShow').hidden = false;
    }else{
        document.getElementById('errorShow').hidden = true;
        formData.append('_token',token);
        if (userId != null) {
            formData.append('id',userId);
        }
        const options = {
            method: 'POST',
            body: formData 
        };
        debugger
        let response = await fetch(url,options);
        if (response.status == 200) {
            let data = await response.json();
            if (data.response == true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Toast Message',
                    text: data.message,
                    timer: 3000, // Duration of the toast in milliseconds (3 seconds)
                    timerProgressBar: true, // Enable timer progress bar
                    toast: true,
                    position: 'top-end', // Position of the toast message
                    showConfirmButton: false // Hide the OK button
                });

                setTimeout(function() {
                    window.location.reload();
                }, 4000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Toast Message',
                    text: data.message,
                    timer: 3000, // Duration of the toast in milliseconds (3 seconds)
                    timerProgressBar: true, // Enable timer progress bar
                    toast: true,
                    position: 'top-end', // Position of the toast message
                    showConfirmButton: false // Hide the OK button
                });
            }
        }
    }        
}

function validateForm(entries) {
    let errorCount = 0;
    entries.forEach(element => {
        if (element[1] == '') {
            errorCount++;
            document.getElementById(element[0]).style.border = '1px solid red';
        }else{
            document.getElementById(element[0]).style.border = '1px solid #dee2e6';
        }
    });

    return errorCount;
}