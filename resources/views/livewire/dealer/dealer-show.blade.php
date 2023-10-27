<div class="row">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Admin Dashboard</li>
                        <li class="breadcrumb-item">Manage Dealers</li>
                        <li class="breadcrumb-item active">Dealers details</li>
                    </ol>
                </div>
                <h4 class="page-title">Dealers details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Dealer Details</h4>
                <span class="float-right">
                    @if ($org->status == 'Approved')
                        <span class="badge badge-lg bg-success">Status : {{ $org->status }}</span>
                    @elseif($org->status == 'Rejected')
                        <span class="badge badge-lg bg-danger">Status : {{ $org->status }}</span>
                    @else
                        <span class="badge badge-lg bg-warning">Status : {{ $org->status }}</span>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Business Name:</th>
                        <td>{{ $org->business_name }}</td>
                        <th>Business Address:</th>
                        <td>{{ $org->business_address }}</td>
                    </tr>
                    <tr>
                        <th>Business Website:</th>
                        <td>{{ $org->business_website }}</td>
                        <th>Business Email:</th>
                        <td>{{ $org->business_email }}</td>
                    </tr>

                    <tr>
                        <th>Business Phone:</th>
                        <td>{{ $org->business_phone }}</td>
                        <th>PCI DSS Compliance:</th>
                        <td>
                            @if ($org->business_PCI_DSS_compliance_status == 1)
                                <h6 class="badge bg-success">Yes</h6>
                            @else
                                <h6 class="badge bg-danger">No</h6>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>HTTPS Compliance:</th>
                        <td>
                            @if ($org->business_HTTPS_compliance_status == 1)
                                <h6 class="badge bg-success">Yes</h6>
                            @else
                                <h6 class="badge bg-danger">No</h6>
                            @endif
                        </td>
                        <th>Business Bank Account Name:</th>
                        <td>{{ $org->business_bank_account_name }}</td>
                    </tr>

                    <tr>
                        <th>Business Bank A/C Address:</th>
                        <td>{{ $org->business_bank_account_address }}</td>
                        <th>Business Bank Name:</th>
                        <td>{{ $org->business_bank_name }}</td>
                    </tr>

                    <tr>
                        <th>Business Bank Address:</th>
                        <td>{{ $org->business_bank_address }}</td>
                        <th>Business IBAN:</th>
                        <td>{{ $org->business_bank_IBAN }}</td>
                    </tr>

                    <tr>
                        <th>Business IFSC:</th>
                        <td>{{ $org->business_bank_IFSC }}</td>
                        <th>Business SWIFT Code:</th>
                        <td>{{ $org->business_bank_SWIFT_code }}</td>
                    </tr>

                    <tr>
                        <th>Business Bank Routing Code:</th>
                        <td colspan="3">{{ $org->business_bank_routing_code }}</td>
                    </tr>
                </table>
                @livewire('admin.admin-actions', ['orgID' => $org->id])
            </div>
        </div>
    </div>
</div>
