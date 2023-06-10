USE [kepatuhan]
GO

/****** Object:  Table [dbo].[pelanggaran_perusahaan]    Script Date: 15/06/2021 18:01:14 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[pelanggaran_perusahaan](
	[id_catatan] [bigint] NOT NULL,
	[pelanggaran_id] [bigint] NOT NULL,
	[perusahaan_id] [smallint] NOT NULL,
	[keterangan] [nvarchar](255) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[pelanggaran_perusahaan]  WITH CHECK ADD  CONSTRAINT [pelanggaran_perusahaan_id_catatan_foreign] FOREIGN KEY([id_catatan])
REFERENCES [dbo].[catatan] ([id])
GO

ALTER TABLE [dbo].[pelanggaran_perusahaan] CHECK CONSTRAINT [pelanggaran_perusahaan_id_catatan_foreign]
GO

ALTER TABLE [dbo].[pelanggaran_perusahaan]  WITH CHECK ADD  CONSTRAINT [pelanggaran_perusahaan_pelanggaran_id_foreign] FOREIGN KEY([pelanggaran_id])
REFERENCES [dbo].[pelanggaran] ([id])
GO

ALTER TABLE [dbo].[pelanggaran_perusahaan] CHECK CONSTRAINT [pelanggaran_perusahaan_pelanggaran_id_foreign]
GO


