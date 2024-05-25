class Gear
	attr_reader :chainring, :cog, :rim, :tire
	def initialize(chainring, cog, rim, tire)
		@chainring = chainring
		@cog = cog
		@rim = rim
		@tire = tire
	end

	# ギア比を計算する
	def ratio
		chainring / cog.to_f
	end

	# ギアインチを計算する
	def gear_inches
		# タイヤはリムの周りを囲むので、直径を計算するためには2倍にする
		ratio * (rim + (tire * 2))
	end
end

puts Gear.new(52, 11, 26, 1.5).gear_inches # 137.0909090909091
puts Gear.new(52, 11, 24, 1.25).gear_inches # 125.27272727272728

puts Gear.new(52, 11).ratio # ArgumentError (wrong number of arguments (given 2, expected 4))