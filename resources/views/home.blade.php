<x-layout-app pageTitle="Home">
    <div class="w-100 p-4">
        <h3>Início</h3>
        <hr>
        <div class="d-flex">
            <x-info-title-value tituloDoItem="Total de colaboradores" :valorDoItem="$data['activeUsersCount']"></x-info-title-value>
            <x-info-title-value tituloDoItem="Total de colaboradores removidos" :valorDoItem="$data['deletedUsersCount']"></x-info-title-value>
            <x-info-title-value tituloDoItem="Salario total" :valorDoItem="$data['totalSalary']"></x-info-title-value>
        </div>
        <div class="d-flex">
            <x-info-title-collection tituloDoItem="Colaboradores por departamento"
                :collection="$data['totalUsersPerDepartment']"></x-info-title-collection>
            <x-info-title-collection tituloDoItem="Salario por departamento" :collection="$data['totalSalaryPerDepartment']"></x-info-title-collection>
        </div>
    </div>
</x-layout-app>
