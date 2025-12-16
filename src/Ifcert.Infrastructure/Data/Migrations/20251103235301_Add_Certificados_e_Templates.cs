using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Ifcert.Infrastructure.Data.Migrations
{
    /// <inheritdoc />
    public partial class Add_Certificados_e_Templates : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "certificado_templates",
                columns: table => new
                {
                    id = table.Column<Guid>(type: "uuid", nullable: false),
                    evento_id = table.Column<Guid>(type: "uuid", nullable: true),
                    nome = table.Column<string>(type: "text", nullable: false),
                    conteudo_html = table.Column<string>(type: "text", nullable: false),
                    background_image_url = table.Column<string>(type: "text", nullable: true),
                    ativo = table.Column<bool>(type: "boolean", nullable: false),
                    data_criacao = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    data_modificacao = table.Column<DateTime>(type: "timestamp with time zone", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_certificado_templates", x => x.id);
                });

            migrationBuilder.CreateTable(
                name: "certificados",
                columns: table => new
                {
                    id = table.Column<Guid>(type: "uuid", nullable: false),
                    inscricao_id = table.Column<Guid>(type: "uuid", nullable: false),
                    atividade_id = table.Column<Guid>(type: "uuid", nullable: false),
                    evento_id = table.Column<Guid>(type: "uuid", nullable: false),
                    participante_id = table.Column<Guid>(type: "uuid", nullable: false),
                    codigo = table.Column<string>(type: "text", nullable: false),
                    emitido_em_utc = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    carga_horaria_h = table.Column<int>(type: "integer", nullable: false),
                    pdf_url = table.Column<string>(type: "character varying(1024)", maxLength: 1024, nullable: true),
                    data_criacao = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    data_modificacao = table.Column<DateTime>(type: "timestamp with time zone", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_certificados", x => x.id);
                });

            migrationBuilder.CreateIndex(
                name: "IX_certificado_templates_nome",
                table: "certificado_templates",
                column: "nome");

            migrationBuilder.CreateIndex(
                name: "IX_certificados_codigo",
                table: "certificados",
                column: "codigo",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "ux_certificado_inscricao",
                table: "certificados",
                column: "inscricao_id",
                unique: true);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "certificado_templates");

            migrationBuilder.DropTable(
                name: "certificados");
        }
    }
}
