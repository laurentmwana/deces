(() => {

    // la responsive du tableau HTML
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll("table.table-responsive").forEach(table => {
            var labels = []
            table.querySelectorAll("table.table-responsive th").forEach((th) => {
                labels.push(th.innerText)
            })
            
            table.querySelectorAll(".table-body td").forEach((td, index) => {
                td.setAttribute("data-label", labels[index % labels.length])
            })
        }) 
    })

    // input checkbox
        const checkbox = document.querySelector("input[type=checkbox][checkbox-all]")
        if (checkbox) {
            var dataCheckboxAll = []
            checkbox.addEventListener("click", () => {
                document.querySelectorAll("input[type=checkbox][check-e]").forEach((element) => {
                    if (checkbox.checked) {
                        element.checked = true
                        dataCheckboxAll.push(element.value)
                    } else {
                        element.checked = false
                        dataCheckboxAll = []
                    }
                })

            })

            
            var dataCheckAll = []
            document.querySelectorAll("input[type=checkbox][check-e]").forEach((check) => {
                check.addEventListener("change", () => {
                    if (check.checked) {
                        check.checked = true
                        dataCheckAll.push(check.value)
                    } else  {
                        check.checked = false
                    }

                    console.log(dataCheckAll);
                })
            })
        }
        // fin de l'input checkbox
    // fin de la responsive du tableau HTML

    

})()