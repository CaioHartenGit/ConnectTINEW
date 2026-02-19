<?php
header("Content-Type: application/json");

$OPENAI_KEY = "SUA_CHAVE_OPENAI_AQUI"; // 🔥 coloque aqui

$data = json_decode(file_get_contents("php://input"), true);

$mensagem = $data["message"] ?? "";

if (!$mensagem) {
    echo json_encode(["reply" => "Mensagem vazia"]);
    exit;
}

$payload = [
    "model" => "gpt-4o-mini",
    "messages" => [
        [
            "role" => "system",
            "content" => "Você é o assistente da plataforma ConnectTI. Ajude usuários com trilhas, cursos e dúvidas de tecnologia."
        ],
        [
            "role" => "user",
            "content" => $mensagem
        ]
    ]
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $OPENAI_KEY"
    ],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

echo json_encode([
    "reply" => $result["choices"][0]["message"]["content"] ?? "Erro ao responder."
]);
