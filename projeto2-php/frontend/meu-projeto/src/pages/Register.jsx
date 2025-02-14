import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Register = () => {
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const navigate = useNavigate();

    const handleRegister = async (e) => {
        e.preventDefault();
        const response = await fetch("http://localhost:5000/public/register.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email, senha }),
        });

        const data = await response.json();
        if (data.status === "success") {
            alert("Cadastro realizado! Faça login.");
            navigate("/");
        } else {
            alert(data.message);
        }
    };

    return (
        <div style={{ textAlign: "center", padding: "50px" }}>
            <h1>Cadastro</h1>
            <form onSubmit={handleRegister}>
                <input
                    type="email"
                    placeholder="E-mail"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />
                <br />
                <input
                    type="password"
                    placeholder="Senha"
                    value={senha}
                    onChange={(e) => setSenha(e.target.value)}
                    required
                />
                <br />
                <button type="submit">Cadastrar</button>
            </form>
            <p>
                Já tem uma conta? <a href="/">Faça login</a>
            </p>
        </div>
    );
};

export default Register;
