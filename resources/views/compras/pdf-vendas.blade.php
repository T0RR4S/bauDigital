<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Histórico de Vendas</h2>
    <p>Gerado em: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itensVendidos as $item)
                <tr>
                    <td>{{ $item->produto->nome }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>{{ formatar_preco($item->preco_unitario) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>