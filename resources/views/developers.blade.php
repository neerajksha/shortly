<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shortly Developer API</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

:root{
    --primary:#4f46e5;
    --secondary:#7c3aed;
    --bg:#f8fafc;
}

body{
    background:var(--bg);
    font-family:Inter,sans-serif;
    color:#1e293b;
}

/* Hero */

.hero{
    background:linear-gradient(
        135deg,
        #4f46e5,
        #7c3aed
    );
    color:white;
    padding:60px 0;
    position:relative;
    overflow:hidden;
}

.hero::before{
    content:'';
    position:absolute;
    width:300px;
    height:300px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    top:-120px;
    right:-80px;
}

.hero h1{
    font-weight:800;
}

.hero p{
    max-width:650px;
    opacity:.9;
}

/* Cards */

.card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(15,23,42,.06);
    transition:.25s;
}

.card:hover{
    transform:translateY(-2px);
}

.card-header{
    background:white;
    border-bottom:1px solid #eef2ff;
    padding:12px 18px;
    font-weight:700;
}

.card-body{
    padding:18px;
}

/* Stat Cards */

.stat-card{
    background:white;
}

.stat-card .card-body{
    padding:18px;
}

.stat-card h6{
    color:#64748b;
    margin-bottom:6px;
    font-size:14px;
}

.stat-card h4{
    font-weight:700;
    margin-bottom:0;
}

/* Code Blocks */

.code-block{
    background:#0f172a;
    color:#e2e8f0;
    border-radius:14px;
    padding:14px 16px;
    overflow:auto;
    font-size:14px;
}

.code-block pre{
    margin:0;
    color:#e2e8f0;
    line-height:1.5;
    font-size:14px;
}

/* Endpoint */

.endpoint{
    font-size:12px;
    font-weight:700;
    border-radius:999px;
    padding:6px 12px;
    display:inline-block;
    margin-right:8px;
}

.get{
    background:#dcfce7;
    color:#15803d;
}

.post{
    background:#dbeafe;
    color:#1d4ed8;
}

.put{
    background:green;
    color:white;
}

.delete{
    background:red;
    color:white;
}

.table{
    margin-bottom:0;
}

.table th{
    font-weight:600;
}

.docs-footer{
    text-align:center;
    color:#64748b;
    margin-top:30px;
}

@media(max-width:768px){

    .hero{
        padding:50px 0;
        text-align:center;
    }

    .hero h1{
        font-size:2rem;
    }

}

</style>


</head>

<body>

<section class="hero">

    <div class="container">

        <span class="badge bg-light text-dark px-3 py-2 mb-3">
            Developer API v1
        </span>

        <h1 class="display-5 fw-bold mb-2">
            Shortly Developer API
        </h1>

        <p class="lead mt-2 mb-4">
            Create short URLs, manage links and retrieve analytics
            programmatically using our REST API.
        </p>

        <div>

            <a
                href="/api-tokens"
                class="btn btn-light"
            >
                Generate Token
            </a>

            <a
                href="#authentication"
                class="btn btn-outline-light ms-2"
            >
                Quick Start
            </a>

        </div>

    </div>

</section>


<div class="container py-5">

<div class="row g-4 mb-4">

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Version</h6>

                <h3>v1</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Authentication</h6>

                <h3>Bearer Token</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Rate Limit</h6>

                <h3>60/min</h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header fw-bold">
        Base URL
    </div>

    <div class="card-body">

        <div class="code-block">
            https://shortly.com/api/v1
        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header fw-bold">
        Authentication
    </div>

    <div class="card-body">

        <p>
            Include your API token in the Authorization header.
        </p>

        <div class="code-block">


            <pre id="auth">Authorization: Bearer YOUR_API_TOKEN</pre>

        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint post">
            POST
        </span>

        /shorten

    </div>

    <div class="card-body">

        <h6>Request</h6>

        <div class="code-block">


<pre>{
    "url": "https://google.com",
    "short_code": "abc123", // optional
    "expires_at": "2026-12-31 23:59:59" // optional
    "passwod": "test@123" // optional
    "remove_password": 0/1 // optional,Boolean
}</pre>


        </div>

        <h6 class="mt-4">
            Response
        </h6>

        <div class="code-block">


<pre>{
    "success": true,
    "message": "URL created successfully",
    "data": {
        "id": 1,
        "short_code": "abc123",
        "short_url": "http://shortly.test/abc123",
        "expires_at": "2026-12-31 23:59:59"
    }
}</pre>


        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint put">
            PUT
        </span>

        /urls/{id}

    </div>

    <div class="card-body">

        <h6>Request</h6>

        <div class="code-block">


<pre>{
    "original_url": "https://openai.com",
    "short_code": "openai",
    "expires_at": "2027-01-01 00:00:00",
    "passwod": "test@123" // optional
    "remove_password": 0/1 // optional,Boolean
}</pre>


        </div>

        <h6 class="mt-4">
            Response
        </h6>

        <div class="code-block">


<pre>{
    "success": true,
    "message": "URL updated successfully",
    "data": {
        "id": 5,
        "short_code": "openai",
        "short_url": "http://shortly.test/openai",
        "original_url": "https://openai.com",
        "expires_at": "2027-01-01T00:00:00.000000Z"
    }
}</pre>


        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint get">
            GET
        </span>

        /urls

    </div>

    <div class="card-body">

        <p>
            Retrieve all URLs belonging to the authenticated user.
        </p>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint delete">
            DELETE
        </span>

        /urls/{id}

    </div>

    <div class="card-body">

        <p>
            Delete a URL belonging to the authenticated user.
        </p>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint get">
            GET
        </span>

        /urls/{id}/analytics

    </div>

    <div class="card-body">

        <div class="code-block">


<pre>{
    "success": true,
    "message": "Analytics fetched successfully",
    "data": {
        "clicks": 125,
        "unique_visitors": 48
    }
}</pre>


        </div>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header">

        <span class="endpoint get">
            GET
        </span>

        /urls/{id}/clicks

    </div>

    <div class="card-body">

        <p>
            Returns paginated click logs.
        </p>

    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header fw-bold">
        Error Codes
    </div>

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>Status</th>
                    <th>Description</th>

                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>401</td>
                    <td>Unauthorized</td>
                </tr>

                <tr>
                    <td>403</td>
                    <td>Forbidden</td>
                </tr>

                <tr>
                    <td>404</td>
                    <td>Not Found</td>
                </tr>

                <tr>
                    <td>429</td>
                    <td>Rate Limit Exceeded</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-header fw-bold">
        Changelog
    </div>

    <div class="card-body">

        <ul>

            <li>
                v1.0 — Initial API Release
            </li>

        </ul>

    </div>

</div>

</div>

</body>

</html>
