class Gear
	attr_reader :chainring, :cog
	def initialize(chainring, cog)
		@chainring = chainring
		@cog = cog
	end

	# ギア比を計算する
	def ratio
		chainring / cog.to_f
	end
end

class Wheel
	attr_reader :rim, :tire
	def initialize(rim, tire)
		@rim = rim
		@tire = tire
	end

	# リムとタイヤの直径を計算する
	def diameter
		rim + (tire * 2)
	end

	# ギアインチを計算する
	def gear_inches(gear)
		gear.ratio * diameter
	end
end

gear = Gear.new(52, 11)
wheel = Wheel.new(26, 1.5)
puts wheel.gear_inches(gear) # 137.0909090909091

gear = Gear.new(52, 11)
wheel = Wheel.new(24, 1.25)
puts wheel.gear_inches(gear) # 125.27272727272728
