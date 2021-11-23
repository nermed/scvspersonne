import './styles/userscss.css';

const btnAddEmployee = $(function() {
    $(document).on('click', '.employee_ajout', function() {
        // console.log('hey')
        const employee_id = $(this).attr('employeeid');
        const commande = $(this).attr('commande');
        const url = $(this).attr('url');
        // console.log(url)
        $.ajax({
            url: url + '/commandes/employee/new',
            method: "POST",
            data: {
                commande: commande, employee_id: employee_id
            },
            dataType: "json",
            success: function(data) {
                window.location.reload();
            }
        })
    })
})

// btnAddEmployee();

document.addEventListener('turbolinks:load', btnAddEmployee);