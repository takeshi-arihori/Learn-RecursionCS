import type { NextApiRequest, NextApiResponse } from "next";

type HelloResponse = {
  name: string;
};

// /api/helloで呼ばれた時のAPIの挙動を実装する
export default (req: NextApiRequest, res: NextApiResponse<HelloResponse>) => {
  // ステータス200で{"name":"John Doe"}を返す
  res.status(200).json({ name: "John Doe" });
};
